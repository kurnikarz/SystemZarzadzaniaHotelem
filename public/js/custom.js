$(document).ready(function () {
    $("#add-field").click(function(){

        this.value= "";
        let name_number = this.name.match(/\d+/);
        name_number++;
        this.name = this.name.replace(/\[[0-9]\]+/, '['+name_number+']')
    });

   let bodyCLass = $("body").attr('class');
   if (bodyCLass === 'reservation') {
       if ($("#intro").height() < 768) {
           $("#intro").css("height","100vh")
       }
   }

})
