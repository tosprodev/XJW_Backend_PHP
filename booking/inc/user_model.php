
<a><span class="fw-bold" data-bs-toggle="modal" data-bs-target="#MyId<?php echo $vid;?>">
												<?php echo $client_name;?>
												</span></a>
												<!-- Edit User Modal -->
                <div class="modal fade" id="MyId<?php echo $vid;?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-5 px-sm-5 pt-50">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">User Information</h1>
                                </div>
                                <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                        <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="<?php echo $_SESSION['first_name'];?>" value="<?php echo $firstname;?>" disabled data-msg="Please enter your first name" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                        <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="<?php echo $_SESSION['last_name'];?>" value="<?php echo $lastname;?>" data-msg="Please enter your last name" disabled />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserEmail">Email:</label>
                                        <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" value="<?php echo $_SESSION['email'];?>" placeholder="<?php echo $xemail;?>" disabled />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditTaxID">Gender</label>
                                        <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="<?php echo $_SESSION['gender'];?>" value="<?php echo $xgender;?>" disabled />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserPhone">Contact</label>
                                        <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="<?php echo "+".$ccode." ".$phone;?>" value="<?php echo "+".$ccode." ".$phone;?>" disabled />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserPhone">Jioned On</label>
                                        <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="<?php echo $doj;?>" value="<?php echo $doj;?>" disabled />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Edit User Modal -->
				
			