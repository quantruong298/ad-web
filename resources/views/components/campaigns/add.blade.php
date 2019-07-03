<div class="row d-flex justify-content-center modalWrapper">
    <div class="modal fade addNewInputs" id="modalAddCampaign" tabindex="-1" role="dialog"
         aria-labelledby="modalAddCampaign"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-primary ml-5">Create New Campaign Form</h4>
                    <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form method="POST" id="formAdd" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseDetail" aria-expanded="false"
                                           aria-controls="collapseTwo">
                                            Detail
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseDetail" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="panel-body-content">
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Name</label>
                                                <div class="col-10">
                                                    <input class="form-control"
                                                           type="text"
                                                           name="name"
                                                           id="campaign-name-add"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-name-add"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Status</label>
                                                <div class="col-5">
                                                    <select class="form-control"
                                                            name="status"
                                                            id="campaign-status-add"
                                                            required>
                                                        <option value="{{\App\Enum\CampaignStatus::ACTIVE}}">ACTIVE
                                                        </option>
                                                        <option value="{{\App\Enum\CampaignStatus::INACTIVE}}">
                                                            INACTIVE
                                                        </option>
                                                    </select>
                                                    <span class="text-danger">
                                                        <strong id="error-status-add"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseSchedule" aria-expanded="false"
                                           aria-controls="collapseThree">
                                            Schedule
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSchedule" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <div class="panel-body-content">
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Start day</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="datetime-local"
                                                           value="2019-06-10T00:00:00"
                                                           id="campaign-start-day-add"
                                                           required
                                                           name="startday">
                                                    <span class="text-danger">
                                                        <strong id="error-start-day-add"></strong>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">End day</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="datetime-local"
                                                           value="2011-08-19T13:45:00"
                                                           id="campaign-end-day-add"
                                                           required
                                                           name="endday">
                                                    <span class="text-danger">
                                                        <strong id="error-end-day-add"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseBudget" aria-expanded="false"
                                           aria-controls="collapseThree">
                                            Budget
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseBudget" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <div class="panel-body-content">
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Budget</label>
                                                <div class="col-5">
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                               aria-describedby="basic-addon1"
                                                               name="budget"
                                                               id="campaign-budget-add"
                                                               required>
                                                    </div>
                                                    <span class="text-danger">
                                                            <strong id="error-budget-add"></strong>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseBidding" aria-expanded="false"
                                           aria-controls="collapseThree">
                                            Bidding
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseBidding" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <div class="panel-body-content">
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Bid Amount</label>
                                                <div class="col-5">
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                               placeholder=""
                                                               aria-describedby="basic-addon1"
                                                               name="bid"
                                                               id="campaign-bid-add"
                                                               required
                                                        >
                                                    </div>
                                                    <span class="text-danger">
                                                        <strong id="error-bid-add"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#collapseCreative" aria-expanded="false"
                                           aria-controls="collapseThree">
                                            Creative
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseCreative" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <div class="panel-body-content">
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Title</label>
                                                <div class="col-10">
                                                    <input class="form-control"
                                                           type="text"
                                                           id="campaign-title-add"
                                                           name="title"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-title-add"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Description</label>
                                                <div class="col-10">
                                                    <input class="form-control"
                                                           type="text"
                                                           value=""
                                                           id="campaign-description-add"
                                                           name="description"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-description-add"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Creative Preview</label>
                                                <div class="col-5 file-upload">
                                                    <input type="file" id="campaign-file-add"
                                                           name="creativepreview"
                                                           onchange="readURL(this);"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label"></label>
                                                <div class="col-5" id="preview-image-wrap" hidden>
                                                    <img id="preview-image" src="#" alt="preview image"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label"></label>
                                                <div class="col-5">
                                                    <span class="text-danger">
                                                        <strong id="error-file-add"></strong>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Final URL</label>
                                                <div class="col-10">
                                                    <input class="form-control"
                                                           type="text"
                                                           name="finalurl"
                                                           id="campaign-final-url-add"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-final-url-add"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"
                                    id="submitFormAdd">GET STARTED
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

