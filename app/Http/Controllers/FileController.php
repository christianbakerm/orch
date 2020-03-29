<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\File;
use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * @var FileRepository
     *
     */
     protected $files;


    /**
     *
     * @param  FileRepository  $files
     * @return void
     */
    public function __construct(FileRepository $files)
    {
            $this->middleware('auth');

            $this->files = $files;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */

    public function files(Request $request)
    {
        return view('files' , [
          'files' => $this->files->forUser($request->user()),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $fileName = $request->file->getClientOriginalName();


        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success','You have successfully uploaded ' .$fileName)
            ->with('file',$fileName);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|max:255',
        ]);

        $request->user()->files()->create([
            'name' => $request->file->getClientOriginalName(),
        ]);

        //store in public/uploads/
        $newFileName = $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads'), $newFileName);
        return redirect('/files');
    }

    public function destroy(Request $request, File $file)
    {
        $this->authorize('destroy', $file);
        $file->delete();
        $filename = $file->name;
        unlink(public_path('uploads/' .$filename));
        return redirect('/files');
    }

    public function delete($filename)
    {

      return redirect($filename);
      #\Storage::delete($file);

    }

}
