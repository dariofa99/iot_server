var socket = io('http://localhost:3000', {secure: true});

socket.on('LIuOgI52dWJxe0ZMMyChannel', function(data){
    console.log("data.sol_id");    

});
console.log("Wiiis");
/* socket.on('LIuOgI52dWJxe0ZMsolicitudes_send', function(data){

    if(data.solicitud_id == $("#solicitud_id").val()){
        $("#content_solicitud_espera").html(data.render);
        console.log("Aqui estoy")
        //x = setInterval(displayTime, 1000);
        window.location.reload(true);
    }
   if(data.tur_aten!=null) $("#lbl_turno").text(data.tur_aten);

});

socket.on('LIuOgI52dWJxe0ZMsolicitudes_coord', function(data){
    //x = setInterval(displayTime, 1000);
    if(data.solicitud_id == $("#solicitud_id").val()){
        if(data.type_status)  $("#lbl_status_sol").html(data.type_status);
        //
        if($("#content_edit_solicitud").length > 0 && (data.type_status_id==165 || data.type_status_id==158)) {
           // $("#con_timer").remove();
            window.location.reload(true)
        }

    }
    if(data.render){
        $("#content_list_solicitudes").html(data.render);
    }
    if(data.renderh)$("#content_list_solicitudesh").html(data.renderh);
});


socket.on('LIuOgI52dWJxe0ZMnotifications_'+$("#user_session_idnumber").val(), function(data){
    if(data.render){
        $("#table_list_model").html(data.render);
    }

    if(data.notifications) $("#menu-notification").html(data.notifications); //$("").html(data.notifications)

}); */






