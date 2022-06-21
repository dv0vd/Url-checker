$("#addUrlForm").submit(function(e){
    e.preventDefault();
    var postData = {
        url: $("#url").val(),
        freq: $("#freq").val(),
        repeats: $("#repeats").val()
    };
    $.ajax({
      url: '/addUrl',
      type: "post",
      dataType: 'JSON',
      data: postData,
      success: function (data) {
        if(data.length > 1) {
            alert("Произошли ошибки! Подробнее в логах");
            for(var i = 0; i <= data.length; i++) {
                console.log(data[i].message);
            }
            return;
        }
        alert(data[0].message);
      },
      error: function (data) {
        alert("Произошла неизвестная ошибка");
      }
    });
});