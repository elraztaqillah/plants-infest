<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index() {
        return Post::all();
        // return "hello";
    }
    // unutk menampilkan semua post 

    public function store(Request $request){


        // Validasi Request
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif,jfif',
            // 'caption' => 'required'
        ]);

        // Mengupload gambar ke local srver 
        $folder = 'post_images';
        $image = $request->file('image');
        $imageName = time() . "_" . $image->getClientOriginalName();
        $image->move($folder, $imageName);


        // Mengupload gambar ke dataabase
        return Post::create([
            'caption' => $request->caption,
            'image' => $imageName,
            'user_id' => 1
        ]);
    }
    // agar tersimpan didalam request

    public function show(Post $post){
        return $post;
    }
    #agar dpt memanggil salah satu ID

    public function update(Request $request, Post $post){
                        // menerima postingan lama, dan baru

        $post->update([
            'caption' => $request->caption
            // data barunya
        ]);

        return response([
            'message' => 'postingan berhasil diedit'
        ]);
    }
    // utk update 

    public function destroy(Post $post){

        // menghapus gambar di local server 
        $path = "post_images/".$post->getRawOriginal('image');
        if (File::exists($path))
            File::delete($path);

        // menghapus post didalam databaase
        $post->delete();

        return response([
            'message' => 'Postingan berhasil dhapus'
        ]);
    }
}
