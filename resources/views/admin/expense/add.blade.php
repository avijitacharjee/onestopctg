<button id="previewButton" type="button" class="btn btn-primary m-3" data-toggle="modal" style="width: 25%;"
    data-target="#addModal" class="btn btn-success">+Add Expense</button>
<div class="modal fade .modal-xl" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <form action="/expense" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered " role="document" style="width:100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Add expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modalBody" class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" id=""
                            placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" name="amount" class="form-control" id="" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="date" name="date" class="form-control" id="" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <label for="">Note</label>
                        <textarea type="text" name="note" class="form-control" id="" placeholder="Add some note.."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
