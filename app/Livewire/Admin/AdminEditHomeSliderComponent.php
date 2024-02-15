<?php

namespace App\Livewire\Admin;

namespace App\Livewire\Admin;
use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $top_title;
    public $title;
    public $sub_title;
    public $offer;
    public $link;
    public $status;
    public $image;
    public $slide_id;
    public $newimage;

    public function mount($slide_id){
        $slide=HomeSlider::find($slide_id);
        $this->top_title=$slide->top_title;
        $this->title=$slide->title;
        $this->sub_title=$slide->sub_title;
        $this->offer=$slide->offer;
        $this->link=$slide->link;
        $this->status=$slide->status;
        $this->image=$slide->image;
        $this->slider_id=$slide->id;
        
    }

    public function updateSlide(){
        $this->validate([
            'top_title'=>'required',
            'title'=>'required',
            'sub_title'=>'required',
            'offer'=>'required',
            'link'=>'required',
            'status'=>'required',
        ]);

        $slide=HomeSlider::find($this->slide_id);
        $slide->top_title=$this->top_title;
        $slide->title=$this->title;
        $slide->sub_title=$this->sub_title;
        $slide->offer=$this->offer;
        $slide->link=$this->link;
        $slide->status=$this->status;
        if($this->newimage){
            unlink('assets/imgs/slider/'.$slide->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->getClientOriginalExtension();
            $this->newimage->storeAs('slider',$imageName);
            $slide->image=$imageName;
        }
        
        $slide->save();
        session()->flash('message','Slide has been updated!');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component');
    }
}
