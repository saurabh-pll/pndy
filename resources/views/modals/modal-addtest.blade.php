<div class="modal fade" id="addTest" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Add Test
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('test', 'Select Test', array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <select class="custom-select form-control"  id="test">
                        <option value="">Select Test</option>
                        @foreach ($tests as $test)
                        <option value="{{$test->id}}">{{$test->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('price', 'Enter Price', array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                   <input type="number" id="price" placeholder="0.00" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnAdd" data-dismiss = "modal" class="btn btn-success">Add Test </button>
        </div>
      </div>
    </div>
</div>
