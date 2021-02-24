function saveItem(item, id){
    event.preventDefault();
    if(id === 0){
        alert("Pls login or register");
        return;
    }
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
 
    const url = "https://electrifiideas.com/betaspot/spot/saveItem";
    
    /**$.ajax({
        url: _url,
        type: "POST",
        data:  formData,
        contentType: false,
        cache: false,
        processData:false,
        beforeSend : function()
        {
            $(item).attr('disabled', true);
        },
        success: function(data)
        {
            $('#'+idpreview+'val').val(data.id);
            $('#btn'+idpreview).attr('disabled', false);
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                  $('#img'+idpreview).attr('src' , e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                reader ="";
            }
        },
        error: function(e) 
        {
            $(item).attr('disabled', false);
        }          
    });
    */
    
    
}