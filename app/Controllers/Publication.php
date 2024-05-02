<?php
namespace App\Controllers;
use App\Models\PublicationModel;
use App\Models\ImageModel;
use CodeIgniter\Files\File;


class Publication extends BaseController
{
    public function index()
    {
        $model = new PublicationModel();
        $data['posts'] = $model->show();
        echo view ('header');
        echo view('Publication/all', $data);
        echo view('footer');
    }


    public function add()
   /* {
        $model = new PublicationModel();

        if ($this->request->getMethod() ==='post' && $this->validate(['content' => 'required']))
        {
            $model->save(['content' => $this->request->getPost('content'), 'user' => 1]);
        }
        return redirect()->to(site_url('publication'));
       
    }
*/
{
    $model = new PublicationModel();

    if ($this->request->getMethod() === 'post' && $this->validate(['content' => 'required'])) {
        // Lógica para guardar la publicación
        $postId = $model->save(['content' => $this->request->getPost('content'), 'user' => 1]);

        // Lógica para manejar la carga de imágenes asociadas a la publicación
        if (!empty($_FILES['image']['name'])) {
            $imageModel = new ImageModel();

            // Configuración para la carga de imágenes
            $uploadConfig = [
                'upload_path'   => WRITEPATH . 'uploads', // Ruta donde se guardarán las imágenes
                'allowed_types' => 'gif|jpg|png|jpeg',   // Tipos de archivos permitidos
                'max_size'      => 2048,                  // Tamaño máximo en kilobytes (2MB en este ejemplo)
                'encrypt_name'  => true,                 // Cambiar el nombre del archivo al subirlo
            ];

            // Cargar la configuración
            $this->load->library('upload', $uploadConfig);

            // Realizar la carga de la imagen
            if ($this->upload->do_upload('image')) {
                // Obtener datos de la imagen cargada
                $uploadData = $this->upload->data();
                $imageName = $uploadData['file_name'];

                // Guardar información de la imagen en la base de datos
                $imageModel->save(['publication_id' => $postId, 'filename' => $imageName]);
            } else {
                // Manejar errores de carga de imágenes
                $error = $this->upload->display_errors();
                // Puedes manejar el error según tus necesidades
                session()->setFlashdata('error', $error);
            }
        }
    }

    return redirect()->to(site_url('publication'));
}




    public function edit($id)
    {
        $model = new PublicationModel();

        if ($this->request->getMethod() ==='post' && $this->validate(['content' => 'required']))
        {
            $model->save(['id' => $this->request->getPost('id'), 'content' => $this->request->getPost('content')]);
           return redirect()->to(site_url('publication'));
            
        }
        else {
            $data['post'] = $model->get($id);
            echo view ('header');
            echo view('publication/edit', $data);
            echo view('footer');
        } 
    }
    public function delete($id)
    {
        $model = new PublicationModel();
        $model->delete($id);
        return redirect()->to(site_url('publication'));
        
    }



    
// Lógica para manejar la carga de imágenes
// ...


    public function uploadImage()
    {
        // Asegúrate de que el formulario haya sido enviado como POST
        if ($this->request->getMethod() === 'post') {
            // Obtén el ID de la publicación a la que se asociará la imagen
            $publicationId = $this->request->getPost('publication_id');
    
            // Lógica para manejar la carga de imágenes asociadas a la publicación
            if (!empty($_FILES['image']['name'])) {
                $imageModel = new \App\Models\ImageModel(); // Asegúrate de usar la ruta completa del modelo
    
                // Configuración para la carga de imágenes
                $uploadConfig = [
                    'upload_path'   => WRITEPATH . 'uploads', // Ruta donde se guardarán las imágenes
                    'allowed_types' => 'gif|jpg|png|jpeg',   // Tipos de archivos permitidos
                    'max_size'      => 2048,                  // Tamaño máximo en kilobytes (2MB en este ejemplo)
                    'encrypt_name'  => true,                 // Cambiar el nombre del archivo al subirlo
                ];
    
                // Realizar la carga de la imagen
                $imageFile = $this->request->getFile('image');
    
                if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                    $newName = $imageFile->getRandomName();
                    $imageFile->move(WRITEPATH . 'uploads', $newName);
    
                    // Guardar información de la imagen en la base de datos
                    $imageModel->save(['publication_id' => $publicationId, 'filename' => $newName]);
    
                    // Redirigir a la página de publicaciones después de la carga
                    return redirect()->to(site_url('publication'));
                } else {
                    // Manejar errores de carga de imágenes
                    $error = $imageFile->getErrorString();
                    // Puedes manejar el error según tus necesidades
                    session()->setFlashdata('error', $error);
                }
            }
        }
    
        // Redirigir de nuevo a la página de publicaciones en caso de errores o si el formulario no se ha enviado
        return redirect()->to(site_url('publication'));
    }

}
