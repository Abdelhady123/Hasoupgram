<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use LivewireUI\Modal\ModalComponent;

class FiltersModal extends ModalComponent
{
    public $filters=['Original','Clarendon','Gingham','Moon','Perpetua'];
    public $image;
    public $filterd_image;
    public $temp_images=[];
    public $description;
    public $listeners=['add_temp_image','modalClosed'=>'delete_temp_images'];
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
    public static function dispatchCloseEvent(): bool
    {
         return true;
    }
    public function mount($image){
        $this->image=$image;
        $this->filterd_image=$this->image;
        $this->add_temp_image($image);
    }
    public function filter_original(){
        $this->filterd_image=$this->image;
        $this->dispatch('add_temp_image',$this->filterd_image);
    }
    public function filter_clarendon(){
        $path = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
    
        $img = Image::read($path)
            ->brightness(20)
            ->contrast(15);
    
        // تحديد المسار الكامل حيث سيتم حفظ الصورة المعالجة
        $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . Str::random(30) . '.jpeg';
        
        $img->save($savePath);
    
        // استخدام basename للحصول على اسم الملف
        $this->filterd_image = 'temp' . DIRECTORY_SEPARATOR . basename($savePath);
       //اطلاق حدث  
        $this->dispatch('add_temp_image',$this->filterd_image);

        }
        //second filter
        public function filter_gingham(){
            $path = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
        
            $img = Image::read($path)
                ->brightness(15)
                ->contrast(10);
        
            // تحديد المسار الكامل حيث سيتم حفظ الصورة المعالجة
            $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . Str::random(30) . '.jpeg';
            
            $img->save($savePath);
        
            // استخدام basename للحصول على اسم الملف
            $this->filterd_image = 'temp' . DIRECTORY_SEPARATOR . basename($savePath);
            $this->dispatch('add_temp_image',$this->filterd_image);

            }
            //therd filter
            public function filter_moon(){
                $path = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
            
                $img = Image::read($path)
                    ->brightness(-25)
                    ->contrast(20);
            
                // تحديد المسار الكامل حيث سيتم حفظ الصورة المعالجة
                $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . Str::random(30) . '.jpeg';
                
                $img->save($savePath);
            
                // استخدام basename للحصول على اسم الملف
                $this->filterd_image = 'temp' . DIRECTORY_SEPARATOR . basename($savePath);
                $this->dispatch('add_temp_image',$this->filterd_image);

                }
                //four filter
                public function filter_perpetua(){
                    $path = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
                
                    $img = Image::read($path)
                        ->brightness(5)
                        ->contrast(10);
                
                    // تحديد المسار الكامل حيث سيتم حفظ الصورة المعالجة
                    $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . Str::random(30) . '.jpeg';
                    
                    $img->save($savePath);
                
                    // استخدام basename للحصول على اسم الملف
                    $this->filterd_image = 'temp' . DIRECTORY_SEPARATOR . basename($savePath);
                    $this->dispatch('add_temp_image',$this->filterd_image);

                    }
                    public function publish(){
                        $this->validate([
                            'description'=>'required',
                        ]);
                        $post_image='posts/'.Str::random(30).'jpeg';
                        Storage::move('public/' . $this->filterd_image, 'public/' . $post_image);

                        $post=auth()->user()->posts()->create([
                            'description'=>$this->description,
                            'slug'=>Str::random(10),
                            'image'=>$post_image
                        ]);
                        $this->forceClose()->closeModal();
                    }

        public function add_temp_image($image){
                array_push($this->temp_images,'public/'.$image);
        }
        public function delete_temp_images(){
            Storage::delete($this->temp_images);
        }
    public function render()
    {
        return view('livewire.filters-modal');
    }
}