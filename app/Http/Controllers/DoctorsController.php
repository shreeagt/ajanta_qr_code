<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctors;
use App\Models\Videos;
use Auth;
use DB;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage; // Import the Storage facade



class DoctorsController extends Controller
{
    public function create()
    {
        return view('doctors.create');
    }

    private function storeFile($file)
    {

        $name = $file->getClientOriginalName();
        $name = pathinfo($name, PATHINFO_FILENAME);
        $name = str_replace(' ', '_', $name);
        //unique name to image
        $newImageName = time() . '-' . $name . '.' . $file->extension();
        $filePath = 'inocare/' . $newImageName;
        # store image
        Storage::disk('s3')->put($filePath, file_get_contents($file));
        // $bucket_name = env('AWS_BUCKET');
        // $region = env('AWS_DEFAULT_REGION');

        $bucket_name = config("filestorage.AWS_BUCKET");
        $region = config("filestorage.AWS_DEFAULT_REGION");

        $url = 'https://' . $bucket_name . '.s3.' . $region . '.amazonaws.com/' . $filePath;

        return $url;
    }

    public function insertdoctors(Request $request)
    {
        $idoctor = new Doctors;
        $idoctor->firstname = $request->input('firstname');
        $idoctor->lastname = $request->input('lastname');
        $idoctor->email = $request->input('email');
        $idoctor->contacno = $request->input('contacno');
        $idoctor->city = $request->input('city');
        $idoctor->facebook_link =$request->input('facebook_link');
        $idoctor->insta_link = $request->input('insta_link');
        $idoctor->youtube_link = $request->input('youtube_link');
        $idoctor->website_link = $request->input('website_link');

        if ($request->hasFile('logo')) {
            $logo = $this->storeFile($request->logo);
            $idoctor->logo = $logo;
            $idoctor->croppedPhoto = $logo;
        }
        // Retrieve the soid from the users table and assign it to the soid column of the Doctors model
        $soid = Auth::id();
        $data = DB::table('teamlead_so_map')->where('so_id', $soid)->first();
        $idoctor->teamlead_id = $data->teamlead_id;
        $idoctor->rsm_id = $data->rsm_id;
        $idoctor->soid = $soid;
        $idoctor->save();
        return redirect()->route('doctors.show')->with('success', 'Doctor added');
    }

    public function showdoctors()
    {
        // Retrieve the currently logged-in user's SO ID
        $soid = Auth::id();

        // Retrieve only the doctors created by the logged-in user
        $doctors = Doctors::where('soid', $soid)->get();

        return view('doctors.show', ['doctors' => $doctors]);
    }
    public function destroy(Doctors $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.show');
    }
    public function edit(Doctors $doctor)
    {
        // Retrieve the doctor from the database and pass it to the view
        return view('doctors.edit', ['doctor' => $doctor]);
    }

    public function update(Request $request, Doctors $doctor)
    {
        
        // Update the doctor's details based on the form input
        $doctor->firstname = $request->input('firstname');
        $doctor->lastname = $request->input('lastname');
        $doctor->email = $request->input('email');
        // $doctor->role = $request->input('role');
        $doctor->contacno = $request->input('contacno');
        $doctor->city = $request->input('city');
        $doctor->facebook_link = $request->input('facebook_link');
        $doctor->insta_link = $request->input('insta_link');
        $doctor->youtube_link = $request->input('youtube_link');
        $doctor->website_link = $request->input('website_link');

        if ($request->hasFile('logo')) {
            $logo = $this->storeFile($request->logo);
            $doctor->logo = $logo;
            $doctor->croppedPhoto = $logo;
        } else {
            $doctor->logo = $request->logo;
            $doctor->croppedPhoto = $request->logo;
        }

        // Retrieve the soid from the users table and assign it to the soid column of the Doctors model
        $soid = Auth::id();
        $doctor->soid = $soid;

        $doctor->save();

        // Redirect the user to the show page or any other appropriate page
        return redirect()->route('doctors.show', ['doctor' => $doctor->id]);
    }
    public function link(Doctors $doctor)
    {
        return view('home', ['doctor' => $doctor]);
    }
    public function upload(Request $request)
    {
        // Validate the file
        $request->validate([
            'video_path' => 'required|mimetypes:video/mp4,video/avi,video/quicktime|max:5242880', // Maximum file size is 5MB
        ]);

        // Create the videos/gallery folder if it doesn't exist
        $folderPath = public_path('videos/gallery');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Store the file in the public/videos/gallery folder
        $video = new Videos();
        $video->video_path = $request->file('video_path')->getClientOriginalName(); // Store the original filename in the 'video_path' field
        $request->file('video_path')->move($folderPath, $video->video_path); // Save the video to the public/videos/gallery folder

        // Assign the 'drid' value to the 'drid' column of the 'Videos' model
        $video->drid = $request->dr_id;
        $video->so_id = $request->so_id;
        $video->save();

        // You can perform additional actions here, such as sending notifications or processing the video further
        return redirect()->back()->with('success', 'Video uploaded successfully.');
    }

    public function generateDoctorsPdf($flag)
    {
        $pdf = new Dompdf();
        $pdf->setPaper('A4');
        if ($flag == 'approve_doctors') {
            $doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)->get();
        } elseif ($flag == 'printing_doctors') {
            $doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 0)->get();
        } elseif ($flag == 'dispatch_doctors') {
            $doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)->get();
        } elseif ($flag == 'live_doctors') {
            $doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)->get();
        }

        $html = '<table style="border-collapse: collapse; table-layout: fixed; width: 100%;">';

        $rowCount = 0; // Counter for the number of QR codes in a row

        foreach ($doctors as $doctor) {
            if ($rowCount % 4 === 0) {
                // Start a new row after every fourth QR code
                $html .= '<tr>';
            }

            $html .= '<td style="padding: 10px; text-align: left;">'; // Set text-align:center to center align the QR code and ID
            $html .= '<div class="qrcode">';
            $qrcode = QrCode::size(70)->generate(route('doctors.link', ['doctor' => $doctor->id]));
            $qrcodeData = 'data:image/png;base64,' . base64_encode($qrcode);

            $html .= '<img src="' . $qrcodeData . '">';
            $html .= '<br/>' . $doctor->id; // Display the doctor's ID
            $html .= '</div>';
            $html .= '</td>';

            $rowCount++;

            if ($rowCount % 4 === 0) {
                // Close the row after every fourth QR code
                $html .= '</tr>';
            }
        }

        // Check if there are any remaining QR codes in the last row
        if ($rowCount % 4 !== 0) {
            // Add empty cells to complete the row
            $remainingCells = 4 - ($rowCount % 4);
            for ($i = 0; $i < $remainingCells; $i++) {
                $html .= '<td></td>';
            }

            $html .= '</tr>';
        }

        $html .= '</table>';

        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf->stream('doctors.pdf');
    }
}
