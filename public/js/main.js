$("#addUrlForm").submit(function(e){
    e.preventDefault();
    if(parseInt($("#repeats").val()) >= parseInt($("#freq").val())) {
      alert("Количество повторов должно быть меньше частоты проверки!");
      return;
    }
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
        if(data[0].result) $("#addUrlForm")[0].reset();
      },
      error: function (data) {
        alert("Произошла неизвестная ошибка");
      }
    });
});

$(document).on ("click", ".removeUrlLink", function (e) {
  e.preventDefault();
  if(confirm("Действительно удалить?")){
    $.ajax({
      url: $(this).attr("href"),
      type: "post",
      dataType: 'JSON',
      success: function (data) {
        alert(data.message);
        getUrls();
      },
      error: function (data) {
        alert("Произошла неизвестная ошибка");
      }
    });
  }
});
