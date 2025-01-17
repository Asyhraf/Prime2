jQuery(document).ready(function () {
  // menu items

  var arrayjson = windowvar.sideMenu;
  
  // icon picker options
  var iconPickerOptions = {searchText: "Icons...", labelHeader: "{0}/{1}"};
  // sortable list options
  var sortableListOptions = {
    placeholderCss: {'background-color': "#cccccc"}
  };

  var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
  editor.setForm($('#frmEdit'));
  editor.setUpdateButton($('#btnUpdate'));
  editor.setData(arrayjson);

  $('#btnReload').on('click', function () {
      editor.setData(arrayjson);
  });
  
  $('#clear').on('click', function () {
    $("#myEditor").empty();
  });

  $('#copy').on('click', function () {
    var copyText = document.getElementById("out");
      copyText.select();
      document.execCommand("copy");
  });


  $('#downloadjsondata').on('click', function () {
    var str = editor.getString();
    console.log(str);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
       type:'post', 
       url:'/download-menu',
       data: {myString:str},
       success:function(data){
          // alert(data);
          editor.setData(data);          
          console.log(data);
       }
    });
  });


  $('#btnOutput').on('click', function () {
    var str = editor.getString();
    $("#out").text(str);
    $("#getRequesthide").hide();
    $("#getRequestpost").show();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
       type:'POST',
       url:'/jsonpost',
       data: {myData:str},
       success:function(data){
          // alert(data);
          editor.setData(data);          
          console.log(data);
       }

    });
  });

  $("#btnUpdate").click(function(){
    editor.update();
  });

  $('#btnAdd').click(function(){
    editor.add();
  });
  /* ====================================== */

});