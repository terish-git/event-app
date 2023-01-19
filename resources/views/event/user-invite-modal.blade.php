<!-- Modal -->
<div class="modal" id="inviteUserModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="text-danger fa fa-times"></i></button>
        <h4 class="modal-title" id="myModalLabel">Invite Users Form</h4>
        </div>
        <div class="modal-body">
            <h5>Event Name: </h5><h5 id="eventHeading"></h5>
            <p><small>Please enter valid Email-Ids with comma separated</small></p>
            <form method="POST" name="invitationForm" id="invitationForm" action="{{ route('invitations.store') }}">
                @csrf
                <input type="hidden" name="eventID" id="eventID" />
                <div class="row mb-3">
                    <label for="end_date" class="col-md-4 col-form-label text-md-end">Email id </label>
                    <div class="col-md-6">
                        <textarea id="userEmails" name="userEmails" required="" placeholder="one@testmail.com, two@testmail.com" class="form-control"></textarea>
                        <!-- <p><small>Please enter Email-Ids with comma separated</small></p> -->
                    </div>
                </div>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Invite Users
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
</div>
<!-- fim Modal-->  