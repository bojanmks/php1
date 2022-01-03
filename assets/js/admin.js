$(document).ready(function() {
    // SECTIONS
    printAdminSection('print-users.php');

    function printAdminSection(fileName) {
        ajaxCallback(`assets/php/admin/${fileName}`, 'get', function(output) {
            $('#adminMain .container').html(output.response);
            addAdminEvents();
        });
    }

    $('#sideNavContent a').click(function(e) {
        e.preventDefault();
        closeSideNav();
        let href = $(this).attr('href');
        printAdminSection(href);
    });

    // BUTTONS
    function addAdminEvents() {
        // ADDING
        $('.btnAdminAdd').click(function() {
            let formFile = $(this).data('form');
            ajaxCallback(`assets/php/admin/adding/forms/${formFile}`, 'get', function(output) {
                adminModal(output.response);
                addingEvents(formFile);
            });
        });

        // adding events
        function addingEvents(formFile) {
            if(formFile == 'add-user-form.php') {
                // username
                var regExpAddUserUsername = /^[a-zA-Z]\w{4,}$/;
                var $tbAddUserUsername = $('#tbAddUserUsername');
                $tbAddUserUsername.blur(checkAddUserUsername);
                function checkAddUserUsername() {
                    checkRegExp($tbAddUserUsername, regExpAddUserUsername);
                }

                // email
                var regExpAddUserEmail = /^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/;
                var $tbAddUserEmail = $('#tbAddUserEmail');
                $tbAddUserEmail.blur(checkAddUserEmail);
                function checkAddUserEmail() {
                    checkRegExp($tbAddUserEmail, regExpAddUserEmail);
                }

                // password
                var regExpAddUserPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
                var $tbAddUserPassword = $('#tbAddUserPassword');
                $tbAddUserPassword.blur(checkAddUserPassword);
                function checkAddUserPassword() {
                    checkRegExp($tbAddUserPassword, regExpAddUserPassword);
                }

                // form submition
                var checkAddUserFunctions = [checkAddUserEmail, checkAddUserPassword, checkAddUserUsername];
                $('#btnAddUser').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkAddUserFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/adding/add-user.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "username": $('#tbAddUserUsername').val(),
                            "email": $('#tbAddUserEmail').val(),
                            "password": $('#tbAddUserPassword').val(),
                            "role": $('#ddlRole').val()
                        });
                    }
                    e.preventDefault();
                });
            } else if(formFile == 'add-device-form.php') {
                // name
                var regExpAddDeviceName = /^[A-Za-z0-9\/\-\s]+$/;
                var $tbAddDeviceName = $('#tbAddDeviceName');
                $tbAddDeviceName.blur(checkAddDeviceName);
                function checkAddDeviceName() {
                    checkRegExp($tbAddDeviceName, regExpAddDeviceName);
                }

                // image
                var regExpAddDeviceImage = /^[\w\-]+(\.jpg|\.jpeg|\.png|\.gif)$/;
                var $tbAddDeviceImage = $('#tbAddDeviceImage');
                $tbAddDeviceImage.blur(checkAddDeviceImage);
                function checkAddDeviceImage() {
                    checkRegExp($tbAddDeviceImage, regExpAddDeviceImage);
                }

                // price
                var regExpAddDevicePrice = /^[0-9]+$/;
                var $tbAddDevicePrice = $('#tbAddDevicePrice');
                $tbAddDevicePrice.blur(checkAddDevicePrice);
                function checkAddDevicePrice() {
                    checkRegExp($tbAddDevicePrice, regExpAddDevicePrice);
                }

                // form submition
                var checkAddDeviceFunctions = [checkAddDeviceName, checkAddDeviceImage, checkAddDevicePrice];
                $('#btnAddDevice').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkAddDeviceFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/adding/add-device.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "name": $('#tbAddDeviceName').val().trim(),
                            "image": $('#tbAddDeviceImage').val(),
                            "os": $('#ddlOS').val(),
                            "brand": $('#ddlBrand').val(),
                            "price": $('#tbAddDevicePrice').val()
                        });
                    }
                    e.preventDefault();
                });
            } else if(formFile == 'add-brand-form.php') {
                // name
                var regExpAddBrandName = /^[A-Za-z\s]+$/;
                var $tbAddBrandName = $('#tbAddBrandName');
                $tbAddBrandName.blur(checkAddBrandName);
                function checkAddBrandName() {
                    checkRegExp($tbAddBrandName, regExpAddBrandName);
                }

                // form submition
                var checkAddBrandFunctions = [checkAddBrandName];
                $('#btnAddBrand').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkAddBrandFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/adding/add-brand.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "name": $('#tbAddBrandName').val().trim()
                        });
                    }
                    e.preventDefault();
                });
            } else if(formFile == 'add-os-form.php') {
                // name
                var regExpAddOSName = /^[A-Za-z\s]+$/;
                var $tbAddOSName = $('#tbAddOSName');
                $tbAddOSName.blur(checkAddOSName);
                function checkAddOSName() {
                    checkRegExp($tbAddOSName, regExpAddOSName);
                }

                // form submition
                var checkAddOSFunctions = [checkAddOSName];
                $('#btnAddOS').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkAddOSFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/adding/add-os.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "name": $('#tbAddOSName').val().trim()
                        });
                    }
                    e.preventDefault();
                });
            }
        }

        // EDITING
        $('.btnEdit').click(function() {
            let formFile = $(this).parents('.adminSection').data('editform');
            let id = $(this).parents('tr').data('id');
            ajaxCallback(`assets/php/admin/editing/forms/${formFile}`, 'post', function(output) {
                adminModal(output.response);
                editingEvents(formFile, id);
            }, {
                "id": id
            });
        });

        // editing events
        function editingEvents(formFile, id) {
            if(formFile == 'edit-user-form.php') {
                // dropdown list values
                ajaxCallback('assets/php/get-user-by-id.php', 'post', function(output) {
                    $('#ddlEditRole').val(output.role);
                    $('#ddlEditActive').val(output.active);
                }, {
                    "id": id
                });

                // username
                var regExpEditUserUsername = /^[a-zA-Z]\w{4,}$/;
                var $tbEditUserUsername = $('#tbEditUserUsername');
                $tbEditUserUsername.blur(checkEditUserUsername);
                function checkEditUserUsername() {
                    checkRegExp($tbEditUserUsername, regExpEditUserUsername);
                }

                // email
                var regExpEditUserEmail = /^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/;
                var $tbEditUserEmail = $('#tbEditUserEmail');
                $tbEditUserEmail.blur(checkEditUserEmail);
                function checkEditUserEmail() {
                    checkRegExp($tbEditUserEmail, regExpEditUserEmail);
                }

                // password
                $('#chbChangePassword').change(function() {
                    if($(this).is(':checked')) {
                        $('#tbEditUserPassword').attr('disabled', false);
                        checkRegExp($tbEditUserPassword, regExpEditUserPassword);
                    } else {
                        $('#tbEditUserPassword').attr('disabled', true);
                        fieldNeutral($('#tbEditUserPassword'));
                    }
                });

                var regExpEditUserPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
                var $tbEditUserPassword = $('#tbEditUserPassword');
                $tbEditUserPassword.blur(checkEditUserPassword);
                function checkEditUserPassword() {
                    if($('#chbChangePassword').is(':checked')) {
                        checkRegExp($tbEditUserPassword, regExpEditUserPassword);
                    }
                }

                // form submition
                var checkEditUserFunctions = [checkEditUserEmail, checkEditUserPassword, checkEditUserUsername];
                $('#btnEditUser').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkEditUserFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/editing/edit-user.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "id": id,
                            "username": $('#tbEditUserUsername').val(),
                            "email": $('#tbEditUserEmail').val(),
                            "password": $('#tbEditUserPassword').val(),
                            "changePassword": Number($('#chbChangePassword').is(':checked')),
                            "role": $('#ddlEditRole').val(),
                            "active": $('#ddlEditActive').val()
                        });
                    }
                    e.preventDefault();
                });
            } else if(formFile == 'edit-device-form.php') {
                // dropdown list values
                ajaxCallback('assets/php/get-device-by-id.php', 'post', function(output) {
                    $('#ddlEditOS').val(output.os);
                    $('#ddlEditBrand').val(output.brand);
                    $('#ddlEditDeviceActive').val(output.active);
                }, {
                    "id": id
                });

                // name
                var regExpEditDeviceName = /^[A-Za-z0-9\/\-\s]+$/;
                var $tbEditDeviceName = $('#tbEditDeviceName');
                $tbEditDeviceName.blur(checkEditDeviceName);
                function checkEditDeviceName() {
                    checkRegExp($tbEditDeviceName, regExpEditDeviceName);
                }

                // image
                var regExpEditDeviceImage = /^[\w\-]+(\.jpg|\.jpeg|\.png|\.gif)$/;
                var $tbEditDeviceImage = $('#tbEditDeviceImage');
                $tbEditDeviceImage.blur(checkEditDeviceImage);
                function checkEditDeviceImage() {
                    checkRegExp($tbEditDeviceImage, regExpEditDeviceImage);
                }

                // price
                var regExpEditDevicePrice = /^[0-9]+$/;
                var $tbEditDevicePrice = $('#tbEditDevicePrice');
                $tbEditDevicePrice.blur(checkEditDevicePrice);
                function checkEditDevicePrice() {
                    checkRegExp($tbEditDevicePrice, regExpEditDevicePrice);
                }

                // form submition
                var checkEditDeviceFunctions = [checkEditDeviceName, checkEditDeviceImage, checkEditDevicePrice];
                $('#btnEditDevice').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkEditDeviceFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/editing/edit-device.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "id": id,
                            "name": $('#tbEditDeviceName').val().trim(),
                            "image": $('#tbEditDeviceImage').val(),
                            "os": $('#ddlEditOS').val(),
                            "brand": $('#ddlEditBrand').val(),
                            "price": $('#tbEditDevicePrice').val(),
                            "active": $('#ddlEditDeviceActive').val()
                        });
                    }
                    e.preventDefault();
                });
            } else if(formFile == 'edit-brand-form.php') {
                // name
                var regExpEditBrandName = /^[A-Za-z\s]+$/;
                var $tbEditBrandName = $('#tbEditBrandName');
                $tbEditBrandName.blur(checkEditBrandName);
                function checkEditBrandName() {
                    checkRegExp($tbEditBrandName, regExpEditBrandName);
                }

                // form submition
                var checkEditBrandFunctions = [checkEditBrandName];
                $('#btnEditBrand').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkEditBrandFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/editing/edit-brand.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "id": id,
                            "name": $('#tbEditBrandName').val().trim()
                        });
                    }
                    e.preventDefault();
                });
            } else if(formFile == 'edit-os-form.php') {
                // name
                var regExpEditOSName = /^[A-Za-z\s]+$/;
                var $tbEditOSName = $('#tbEditOSName');
                $tbEditOSName.blur(checkEditOSName);
                function checkEditOSName() {
                    checkRegExp($tbEditOSName, regExpEditOSName);
                }

                // form submition
                var checkEditOSFunctions = [checkEditOSName];
                $('#btnEditOS').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkEditOSFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/editing/edit-os.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "id": id,
                            "name": $('#tbEditOSName').val().trim()
                        });
                    }
                    e.preventDefault();
                });
            } else if(formFile == 'edit-order-form.php') {
                // Buyer name
                var regExpEditOrderBuyerName = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})*$/;
                var $tbEditOrderBuyerName = $('#tbEditOrderBuyerName');
                $tbEditOrderBuyerName.blur(checkEditOrderBuyerName);
                function checkEditOrderBuyerName() {
                    checkRegExp($tbEditOrderBuyerName, regExpEditOrderBuyerName);
                }

                // Buyer email
                var regExpEditOrderBuyerEmail = /^[a-z][a-z0-9\-_\.]{2,}@([a-z0-9\-_]{2,}\.)+[a-z]{2,}$/;
                var $tbEditOrderBuyerEmail = $('#tbEditOrderBuyerEmail');
                $tbEditOrderBuyerEmail.blur(checkEditOrderBuyerEmail);
                function checkEditOrderBuyerEmail() {
                    checkRegExp($tbEditOrderBuyerEmail, regExpEditOrderBuyerEmail);
                }

                // Buyer address
                var regExpEditOrderBuyerAddress = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽa-zšđčćž][a-zšđčćž]{2,})*\s\d+[A-Z]?(\/\d+)*$/;
                var $tbEditOrderBuyerAddress = $('#tbEditOrderBuyerAddress');
                $tbEditOrderBuyerAddress.blur(checkEditOrderBuyerAddress);
                function checkEditOrderBuyerAddress() {
                    checkRegExp($tbEditOrderBuyerAddress, regExpEditOrderBuyerAddress);
                }

                // form submition
                var checkEditOrderFunctions = [checkEditOrderBuyerName, checkEditOrderBuyerEmail, checkEditOrderBuyerAddress];
                $('#btnEditOrder').click(function(e) {
                    let printFile = $('.adminSection').data('print');
                    submitForm(checkEditOrderFunctions);
                    if(noErrors) {
                        ajaxCallback('assets/php/admin/editing/edit-order.php', 'post', function() {
                            closeAdminModal();
                            printAdminSection(printFile);
                        }, {
                            "id": id,
                            "buyerName": $('#tbEditOrderBuyerName').val(),
                            "buyerEmail": $('#tbEditOrderBuyerEmail').val(),
                            "buyerAddress": $('#tbEditOrderBuyerAddress').val()
                        });
                    }
                    e.preventDefault();
                });
            }
        }

        // DELETING
        $('.btnDelete').click(function() {
            let id;
            if($(this).hasClass('btnDeleteMessage')) id = $(this).parents('.messageContainer').data('id');
            else id = $(this).parents('tr').data('id');
            let fileDelete = $(this).parents('.adminSection').data('delete');
            let filePrint = $(this).parents('.adminSection').data('print');
            openAreYouSureModal(function() {
                ajaxCallback(`assets/php/admin/deleting/${fileDelete}`, 'post', function() {
                    closeModal();
                    printAdminSection(filePrint);
                }, {
                    "id": id
                });
            });
        });
    }
});

// ARE YOU SURE MODAL
function openAreYouSureModal(func) {
    $html = "<div class='areYouSure'><span class='font-small'>Are you sure?</span><span class='areYouSureButtons'><button class='btnYes btnPrimary'>Yes</button><button class='btnNo btnPrimary'>No</button></span></div>";
    openModal($html);
    $('.btnNo').click(closeModal);
    $('.btnYes').click(func);
}

// ADMIN MODAL
function adminModal(content) {
    $('body').append(`<div class="adminModal"><div class="cover"><div class="adminModalContent">${content}<button class="font-medium btnCloseAdminModal"><i class="fas fa-times"></i></button></div></div></div>`);
    $('.adminModal, .adminModalContent').hide();
    $('.adminModal .cover, .btnCloseAdminModal').mousedown(closeAdminModal);
    $('.adminModalContent').mousedown(function(e) {
        e.stopPropagation();
    });
    $('.adminModal').fadeIn('fast', function() {
        $('.adminModalContent').fadeIn('fast');
    });
}

function closeAdminModal() {
    $('.adminModalContent').fadeOut('fast', function() {
        $('.adminModal').fadeOut('fast', function() {
            $('.adminModal').remove();
        });
    });
}