<?php
 
 
function date_form($date,$format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($format);    
}


function uploadImage($image){
    $imageName =  time().'.'.$image->extension();  
    
    $image->move(public_path('images'), $imageName);
    return $imageName;
}

// return full path of
function getImageNameAttribute($image)
{
        
        return url('public/images/' . $image);;
}
?>