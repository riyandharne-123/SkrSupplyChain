function quote(){
        $("#req_callback").hide();
        $("#req_quote").show();
        $("#quote_button").addClass("btn btn-primary");
        $("#callback_button").removeClass("btn btn-primary");
        $("#callback_button").addClass("btn ");
}

function callback(){
    $("#req_callback").show();
    $("#req_quote").hide();
    $("#quote_button").removeClass("btn btn-primary");
    $("#quote_button").addClass("btn ");
    $("#callback_button").addClass("btn btn-primary ");
}