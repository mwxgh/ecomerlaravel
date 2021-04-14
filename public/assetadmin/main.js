function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that=$(this);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
              type:'GET',
              url: urlRequest,
              success:function(data){
                  if (data.code ==200) {
                      that.parent().parent().remove();
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                  }
              },
              error:function(){

              }
          });

      }
    })
}


$(function(){
    $(document).on('click','#action_delete',actionDelete);
});

// manage product
$(function(){
        $("#tags_select_choose").select2({
            tags: true,
            tokenSeparators: [',']
        });
        $("#roles_select_choose").select2({
            tags: true,
            'placeholder':'Choose Role',
            tokenSeparators: [',']
        });
        $("#cat_select").select2({
            placeholder: "Category",
            allowClear: true
        });
          let editor_config = {
            path_absolute : "/",
            selector: 'textarea.tinymce_editor_init',
            relative_urls: false,
            plugins: [
              "advlist autolink lists link image charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime media nonbreaking save table directionality",
              "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback : function(callback, value, meta) {
              let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
              let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

              let cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
              if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
              } else {
                cmsURL = cmsURL + "&type=Files";
              }

              tinyMCE.activeEditor.windowManager.openUrl({
                url : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",
                onMessage: (api, message) => {
                  callback(message.content);
                }
              });
            }
          };

          tinymce.init(editor_config);
    });

    // manage role
$(function(){
    $('.checkbox_wrapper').on('click',function(){
        $(this).parents('.card').find('.checkbox_children').prop('checked',$(this).prop('checked'));
    });
    $('.checkall').on('click',function(){
        $(this).parents().find('.checkbox_children').prop('checked',$(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked',$(this).prop('checked'));
    })
});
