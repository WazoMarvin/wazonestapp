<div class="modal" id="addUser">
    <div class="modal-dialog modal-cmd">
        <form action="{{route('store-user')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title header-font">
                     Add User
                  </h5>
                  <button  type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input required name="name" required type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input required name="email" required type="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input required name="password" required type="password" class="form-control">
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-4">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
          
              </div>
        </form>
    </div>
  </div>