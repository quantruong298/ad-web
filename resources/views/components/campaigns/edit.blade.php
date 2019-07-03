<div class="row d-flex justify-content-center modalWrapper">
    <div class="modal fade addNewInputs" id="modalEditCampaign" tabindex="-1" role="dialog"
         aria-labelledby="modalEditCampaign"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-primary ml-5">Edit Campaign Form</h4>
                    <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form method="post" id="formEdit" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="campaign-id-edit">
                        </div>
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
                                                           id="campaign-name-edit"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-name-edit"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Status</label>
                                                <div class="col-5">
                                                    <select class="form-control"
                                                            name="status"
                                                            id="campaign-status-edit"
                                                            required>
                                                        <option value="{{\App\Enum\CampaignStatus::ACTIVE}}">ACTIVE
                                                        </option>
                                                        <option value="{{\App\Enum\CampaignStatus::INACTIVE}}">
                                                            INACTIVE
                                                        </option>
                                                    </select>
                                                    <span class="text-danger">
                                                        <strong id="error-status-edit"></strong>
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
                                                           id="campaign-start-day-edit"
                                                           required
                                                           name="startday"
                                                           readonly="true">
                                                    <span class="text-danger">
                                                        <strong id="error-start-day-edit"></strong>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">End day</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="datetime-local"
                                                           id="campaign-end-day-edit"
                                                           required
                                                           name="endday">
                                                    <span class="text-danger">
                                                        <strong id="error-end-day-edit"></strong>
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
                                                               id="campaign-budget-edit"
                                                               required>
                                                    </div>
                                                    <span class="text-danger">
                                                        <strong id="error-budget-edit"></strong>
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
                                                               id="campaign-bid-edit"
                                                               required>
                                                    </div>
                                                    <span class="text-danger">
                                                        <strong id="error-bid-edit"></strong>
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
                                                           id="campaign-title-edit"
                                                           name="title"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-title-edit"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Description</label>
                                                <div class="col-10">
                                                    <input class="form-control"
                                                           type="text"
                                                           id="campaign-description-edit"
                                                           name="description"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-description-edit"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label">Creative Preview</label>
                                                <div class="col-5 file-upload">
                                                    <input type="file" id="campaign-file-edit"
                                                           name="creativepreview"
                                                           onchange="readURLEdit(this);">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label"></label>
                                                <div class="col-5">
                                                    <img id="campagin-image-edit" src="#" alt="preview image"
                                                    />
                                                </div>
                                                <div class="col-5" id="preview-image-wrap-edit" hidden>
                                                    <img id="preview-image-edit" src="#" alt="preview image"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                       class="col-2 col-form-label"></label>
                                                <div class="col-5">
                                                    <span class="text-danger">
                                                        <strong id="error-file-edit"></strong>
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
                                                           id="campaign-final-url-edit"
                                                           required>
                                                    <span class="text-danger">
                                                        <strong id="error-final-url-edit"></strong>
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
                                    id="submitFormEdit" disabled="true" >GET STARTED
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

