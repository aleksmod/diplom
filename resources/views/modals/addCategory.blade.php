<!-- Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Category</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['class' => 'form-horizontal', 'method' => 'post', 'route' => 'addCategory']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Category Name</label>
                    <div class="col-sm-6">
                        <input id="input_name" type="text" class="form-control" name="name" style="width: 400px" placeholder="new category">
                    </div>
                </div>

                <div class="form-group">
                    <label for="parent" class="col-sm-3 control-label">Parent Category</label>
                    <div class="col-sm-6">
                        <input id="input_parent_id" class="form-control" type="text" name="parent_id" style="width: 400px" placeholder="parent_id">
                    </div>
                </div>

                <div class="form-group">
                    <label for="slug" class="col-sm-3 control-label">Slug</label>
                    <div class="col-sm-6">
                        <input id="input_slug" class="form-control" type="text" name="slug" style="width: 400px" placeholder="slug">
                    </div>
                </div>

                {{-- <div class="form-group">
                     <div class="col-sm-offset-3 col-sm-6">
                         <br><button type="submit" class="btn btn-success">Create</button>
                     </div>
                 </div>--}}

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="newCategory()">Create</button>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>