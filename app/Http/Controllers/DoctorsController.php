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
    public function insertdoctors(Request $request)
    {
        $folderPath = public_path('logos');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $FolderPath = public_path('photos');
        if (!file_exists($FolderPath)) {
            mkdir($FolderPath, 0777, true);
        }

        $idoctor = new Doctors;
        $idoctor->firstname = $request->input('firstname');
        $idoctor->lastname = $request->input('lastname');
        $idoctor->email = $request->input('email');
        $idoctor->contacno = $request->input('contacno');
        $idoctor->city = $request->input('city');





        // Store the photo from input field as base64 string
        if ($request->has('croppedPhoto')) {
            $png_url = uniqid() . '.png';
            $path = public_path() . "/" . "photos/" . $png_url;
            $img = $request->input('croppedPhoto');
            $img = substr($img, strpos($img, ',') + 1);
            $data = base64_decode($img);
            $success = file_put_contents($path, $data);
            // Save the base64 string to the database
            // $idoctor->croppedPhoto = base64_encode($data);
            $idoctor->croppedPhoto = "/" . "photos/" . $png_url;
        }



        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($folderPath, $logoPath);
            $logo = $request->file('logo');
            // $logoPath = $logo->storeAs('logos', 'logo.png');

            // Save the file path or URL to your model or database if needed
            $idoctor->logo = $logoPath;
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
        $folderPath = public_path('logos');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $FolderPath = public_path('photos');
        if (!file_exists($FolderPath)) {
            mkdir($FolderPath, 0777, true);
        }

        // Update the doctor's details based on the form input
        $doctor->firstname = $request->input('firstname');
        $doctor->lastname = $request->input('lastname');
        $doctor->email = $request->input('email');
        // $doctor->role = $request->input('role');
        $doctor->contacno = $request->input('contacno');
        $doctor->city = $request->input('city');

        // Check if a new photo is uploaded and update the photo path accordingly
        if ($request->has('croppedPhoto')) {
            $png_url = uniqid() . '.png';
            $path = public_path() . "/photos/" . $png_url;
            $img = $request->input('croppedPhoto');
            $img = substr($img, strpos($img, ',') + 1);
            $data = base64_decode($img);
            $success = file_put_contents($path, $data);
            // Save the base64 string to the database
            $doctor->croppedPhoto = "/photos/" . $png_url;
        } else {
            // If no new photo is uploaded, do not update the `croppedPhoto` field
            // This ensures the photo remains unchanged in the database
            $doctor->croppedPhoto = $doctor->croppedPhoto;
        }


        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($folderPath, $logoPath);
            $doctor->logo = $logoPath;
        }

        // dd($request->all());
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

    public function generateDoctorsPdf()
    {
        $pdf = new Dompdf();
        $pdf->setPaper('A4');

        $doctors = Doctors::all(); // Retrieve all doctors from the database

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
