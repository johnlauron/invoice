<form>
<div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="width:55%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="custom-width-modalLabel">Custom Box</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-section">
                                    <div class="buttons">
                                        {{--  toggle  --}}
                                        <input type="button" class="btn btn-primary form-control toggle" value="Header Section"> 
                                        <div class="button-content" id="button-content" style="display:none">
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Field Name</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <input type="text" name="test" class="form-control field_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Width</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <input type="number" name="test" class="form-control width" min="1" step="1" value="155"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Height</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <input type="number" name="test" class="form-control height" min="1" step="1" value="26"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Data Restrictions</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                       <select class="form-control" id="character" required>
                                                                <option value="text">Text</option>
                                                                <option value="email">Email</option>
                                                                <option value="date">Date</option>
                                                                <option value="number">Number</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--pre define---------------------------------------------------->
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Pre-defined</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <input type="text" name="test" class="form-control pre-define" placeholder=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end-->
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Text Alignment</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <select class="form-control" id="alignment" required>
                                                                <option value="">--- Choose Alignment ---</option>
                                                                <option value="Left">Left</option>
                                                                <option value="Center">Center</option>
                                                                <option value="Right">Right</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="submit-button">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                                                    <button type="button" id="btnSave" class="btn btn-primary waves-effect waves-light">Go</button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" class="btn btn-primary form-control second-toggle" value="Line Details Section">
                                        <div class="button-content" id="second-button-content" style="display:none">
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Field Name</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <input type="text" name="test" class="form-control line-field">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Width</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <input type="number" name="test" class="form-control line-width" min="1" step="1" value="155"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Height</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <input type="number" name="test" class="form-control line-height" min="1" step="1" value="26"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Data Restrictions</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                       <select class="form-control" id="line_character" required>
                                                                <option value="text">Text</option>
                                                                <option value="email">Email</option>
                                                                <option value="date">Date</option>
                                                                <option value="number">Number</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row-body">
                                                    <div class="col-md-3 col-lg-3 align-left">
                                                        <label>Text Alignment</label>
                                                    </div>
                                                    <div class="col-md-9 col-lg-9">
                                                        <select class="form-control" id="line_alignment" required>
                                                                <option value="">--- Choose Alignment ---</option>
                                                                <option value="Left">Left</option>
                                                                <option value="Center">Center</option>
                                                                <option value="Right">Right</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="submit-button">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                                                    <button type="button" id="secondbtnSave" class="btn btn-primary waves-effect waves-light">Go</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  end of toggle  --}}
                            <script src="{{asset('js/toggle.js')}}"></script>
                            {{--  <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light">Go</button>
                            </div>  --}}
                        </div>
                    </div>
                </div>
                </form>