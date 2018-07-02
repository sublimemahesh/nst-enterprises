<div class="modal fade" id="modal-consignee" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Consignee</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" id="consignee-name" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" placeholder="Enter address" id="address" id="address"></textarea>
                </div>
                <div class="form-group">
                    <label>VAT Number</label>
                    <input type="text" class="form-control" placeholder="Enter VAT number" id="vatNumber">
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" placeholder="Enter contact number" id="contactNumber">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter email" id="email">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" placeholder="Enter description" id="description"></textarea>
                </div>
                <button type="button" name="create-consignee" id="btn-consignee" class="btn btn-info">Save Consignee</button>
            </div>

        </div>

    </div>
</div>
<div class="modal fade" id="modal-consignment" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Consignment</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="name" id="consignment-name">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" placeholder="Enter description" id="description1"></textarea>
                </div>
                <button type="button" name="create-consignment" id="btn-consignment" class="btn btn-info">Save</button>
            </div>

        </div>

    </div>
</div>
