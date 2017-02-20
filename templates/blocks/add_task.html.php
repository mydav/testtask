<style>

    #text-body-task{
      float: left;

    }
    #preview img{

      width: 200px;
      height: 140px;

    }
  </style>

<form role="form" action="/tasks/record_task" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="text-task">Task</label>
        <textarea class="form-control" name="task" id="text-task" rows="3" placeholder="Text" required></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" name="file" id="exampleInputFile">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>
<hr>
<button class="btn btn-default" onclick="showPreview()">Preview</button>
<br><br>
<div class="container" id="previewBlok" >
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="col-md-3" id="preview">
                    <img class="thumbnail" src="" alt="">
                </div>
                <p id="text-body-task"> </p>

            </div>
            <div class="panel-footer">
                <span class="glyphicon glyphicon-user" id="start"></span> <label id="started">By</label> <a href="#" id="startedby">

                </a> |
                <span class="glyphicon glyphicon glyphicon-time" id="visit"></span> <a href="#" id="visited">

                </a> |

            </div>
        </div>
    </div>
</div>
<hr>
<script type="application/javascript">
    $('#text-task').keyup(function(eventObject){
        $('#text-body-task').html($('#text-task').val());
    });
    $('#name').keyup(function(eventObject){
        $('#startedby').html($('#name').val());
    });

    $("#previewBlok").hide();

    function showPreview() {
        $('#previewBlok').show();

    }
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', 'input[type="file"]', function(){
        readURL(this);
    });

</script>
