$(document).ready(function() {
    // LOGIN MODAL
    $('.btnLogin').click(function(e) {
        e.preventDefault();
    });

    $('#btnLogin').click(function() {
        openLoginModal('login');
    });

    $('#btnRegister').click(function() {
        openLoginModal('register');
    });

    function openLoginModal(data) {
        $('body').append("<div id='loginModal'><div class='cover'><div id='loginContainer'><div id='loginModalContent'></div><button id='btnCloseLoginModal' class='font-medium'><i class='fas fa-times'></i></butotn></div></div></div>");
        loginModalContent(data);
        $('#loginModal .cover, #btnCloseLoginModal').mousedown(closeLoginModal);
        $('#loginContainer').mousedown(function(e) {
            e.stopPropagation();
        });
        $('#loginModal .cover, #loginContainer').hide();
        $('#loginModal .cover').fadeIn('fast', function() {
            $('#loginContainer').fadeIn('fast');
        });
    }

    function closeLoginModal() {
        $('#loginContainer').fadeOut('fast', function() {
            $('#loginModal .cover').fadeOut('fast', function() {
                $('#loginModal').remove();
            });
        });
    }

    function loginModalContent(data) {
        let html;
        if(data == 'login') {
            html = "<h3 class='font-large textCenter'>Log in</h3><form class='font-small'><div class='formGroup'><label for='tbLoginEmail'>Email:</label><input type='email' id='tbLoginEmail' class='textField font-small' autocomplete='off'/><label class='errorMessage font-small'>examplename@example.com</label></div><div class='formGroup'><label for='tbLoginPassword'>Password:</label><input type='password' id='tbLoginPassword' class='textField font-small'/><label class='errorMessage font-small'>Your password must:<ul><li>- contain 1 lowercase letter</li><li>- contain 1 uppercase letter</li><li>- contain 1 number</li><li>- contain 1 special character</li><li>- be 8 characters or longer</li></ul></label></div><div class='formGroup'><button id='btnLoginSubmit' class='btnPrimary font-small'>Log in</button></div></form><a href='#' id='changeToRegister' class='font-small'>Not a user? Register here</a>";
        } else {
            html = "<h3 class='font-large textCenter'>Register</h3><form class='font-small'><div class='formGroup'><label for='tbRegisterUsername'>Username:</label><input type='text' id='tbRegisterUsername' maxlength='20' class='textField font-small' autocomplete='off'/><label class='errorMessage font-small'>Your username must:<ul><li>- start with a letter</li><li>- be 5 characters or longer</li><li>- not contain special characters other than '_'</li></ul></label></div><div class='formGroup'><label for='tbRegisterEmail'>Email:</label><input type='email' id='tbRegisterEmail' class='textField font-small' autocomplete='off'/><label class='errorMessage font-small'>examplename@example.com</label></div><div class='formGroup'><label for='tbRegisterPassword'>Password:</label><input type='password' id='tbRegisterPassword' class='textField font-small'/><label class='errorMessage font-small'>Your password must:<ul><li>- contain 1 lowercase letter</li><li>- contain 1 uppercase letter</li><li>- contain 1 number</li><li>- contain 1 special character</li><li>- be 8 characters or longer</li></ul></label></div><div class='formGroup'><label for='tbRegisterRepeatPassword'>Repeat Password:</label><input type='password' id='tbRegisterRepeatPassword' class='textField font-small'/><label class='errorMessage font-small'>Passwords don't match</label></div><div class='formGroup'><button id='btnRegisterSubmit' class='btnPrimary font-small'>Register</button></div></form><a href='#' id='changeToLogin' class='font-small'>Already have an account? Log in</a>";
        }
        $('#loginModalContent').html(html);
        $('#loginModalContent a').click(function(e) {
            e.preventDefault();
            if($(this).attr('id') == 'changeToRegister') loginModalContent('register');
            else loginModalContent('login');
        });

        // form validation
        if(data == 'login') {
            // LOGIN
            // email
            var regExpLoginEmail = /^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/;
            var $tbLoginEmail = $('#tbLoginEmail');
            $tbLoginEmail.blur(checkLoginEmail);
            function checkLoginEmail() {
                checkRegExp($tbLoginEmail, regExpLoginEmail);
            }

            // password
            var regExpLoginPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
            var $tbLoginPassword = $('#tbLoginPassword');
            $tbLoginPassword.blur(checkLoginPassword);
            function checkLoginPassword() {
                checkRegExp($tbLoginPassword, regExpLoginPassword);
            }

            // form submition
            var checkLoginFunctions = [checkLoginEmail, checkLoginPassword];
            $('#btnLoginSubmit').click(function(e) {
                submitForm(checkLoginFunctions);
                if(noErrors) {
                    ajaxCallback('assets/php/forms/login-form-validation.php', 'post', function() {
                        location.reload();
                    }, {
                        "email": $('#tbLoginEmail').val(),
                        "password": $('#tbLoginPassword').val()
                    });
                }
                e.preventDefault();
            });
        } else {
            // REGISTRATION
            // username
            var regExpRegisterUsername = /^[a-zA-Z]\w{4,}$/;
            var $tbRegisterUsername = $('#tbRegisterUsername');
            $tbRegisterUsername.blur(checkRegisterUsername);
            function checkRegisterUsername() {
                checkRegExp($tbRegisterUsername, regExpRegisterUsername);
            }

            // email
            var regExpRegisterEmail = /^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/;
            var $tbRegisterEmail = $('#tbRegisterEmail');
            $tbRegisterEmail.blur(checkRegisterEmail);
            function checkRegisterEmail() {
                checkRegExp($tbRegisterEmail, regExpRegisterEmail);
            }

            // password
            var regExpRegisterPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
            var $tbRegisterPassword = $('#tbRegisterPassword');
            $tbRegisterPassword.blur(checkRegisterPassword);
            function checkRegisterPassword() {
                checkRegExp($tbRegisterPassword, regExpRegisterPassword);
                if($('#tbRegisterRepeatPassword').val() != '') checkRegisterRepeatPassword();
            }

            // repeat password
            var $tbRegisterRepeatPassword = $('#tbRegisterRepeatPassword');
            $tbRegisterRepeatPassword.blur(checkRegisterRepeatPassword);
            function checkRegisterRepeatPassword() {
                if($($tbRegisterPassword).hasClass('borderYellow') && $($tbRegisterRepeatPassword).val() == $($tbRegisterPassword).val()) {
                    fieldCorrect($tbRegisterRepeatPassword);
                } else {
                    fieldIncorrect($tbRegisterRepeatPassword);
                }
            }

            // form submition
            var checkRegisterFunctions = [checkRegisterEmail, checkRegisterPassword, checkRegisterRepeatPassword, checkRegisterUsername];
            $('#btnRegisterSubmit').click(function(e) {
                submitForm(checkRegisterFunctions);
                if(noErrors) {
                    ajaxCallback('assets/php/forms/register-form-validation.php', 'post', function(output) {
                        clearForm($('#loginModalContent form'));
                        closeLoginModal();
                        openModal(output.response);
                    }, {
                        "username": $('#tbRegisterUsername').val(),
                        "email": $('#tbRegisterEmail').val(),
                        "password": $('#tbRegisterPassword').val(),
                        "repeatPassword": $('#tbRegisterRepeatPassword').val()
                    });
                }
                e.preventDefault();
            });
        }
    }

    // ACTIVE CLASS
    addActiveClass();

    function addActiveClass() {
        var currentPage = location.pathname;
        var pageRegExp = /[(\.html)|(\.php)]$/;
        if(!currentPage.match(pageRegExp)) currentPage = '/index.php';
        currentPage = currentPage.substring(currentPage.lastIndexOf('/') + 1, currentPage.length);
        $('#nav ul li a, #sideNavContent ul li a').each(function() {
            $this = $(this);
            if($this.attr('href').indexOf(currentPage) != -1){
                $this.addClass('active');
                $this.click(function(e) {
                    e.preventDefault();
                });
            }
        });
    }

    // CART
    $('#cart a').click(function(e) {
        ajaxCallback("assets/php/cart-access.php", "get", function() {
            location.href = "cart.php";
        });
        e.preventDefault();
    });

    printCartNumber();

    // SIDENAV
    $('#sideNavContent').css('transition', `transform ${sideNavOpenDuration / 1000}s`);
    $('#sideNav').hide();
    $('#hamburger a').click(function(e) {
        $('#sideNav').fadeIn('fast', function() {
            $('#sideNavContent').css('transform', 'translateX(0px)');
        });
        e.preventDefault();
    });
    $('#sideNav .cover').click(closeSideNav);
    $('#sideNavContent').click(function(e) {
        e.stopPropagation();
    });

    // SCROLL TO TOP
    $('body').append('<a href="#" id="toTop"><span class="arrow"></span></div>');
    $('#toTop').click(function(e) {
        $(document).scrollTop(0);
        e.preventDefault();
    }).hide();
    $(document).scroll(function() {
        if($(this).scrollTop() >= 200) $('#toTop').fadeIn('fast');
        else $('#toTop').fadeOut('fast');
    });

    // FORM SUBMIT ON ENTER
    $('.textField').keydown(function(e) {
        if(e.keyCode == 13) {
            e.preventDefault();
        }
    });

    // SURVEY
    $('#btnSubmitSurvey').click(function(e) {
        e.preventDefault();
        let rating = $('.rbSurvey:checked').val();
        if(rating) {
            ajaxCallback("assets/php/forms/survey-submition.php", "get", function() {
                location.reload();
            }, {
                "rating": rating
            });
        } else {
            openModal("Please choose one of the options.");
        }
    });

    $('#btnSurveyResults').click(function() {
        ajaxCallback("assets/php/pages/survey-results.php", "get", function(output) {
            openModal(output.response);
        });
    });

    $('#btnCloseSurveyBar').click(function() {
        ajaxCallback("assets/php/close-survey-bar.php", "get", function() {
            $('#survey').slideUp('fast', function() {
                $(this).remove();
            });
        });
    });
});

// AJAX
function ajaxCallback(file, requestMethod, result, requestData = {}) {
    $.ajax({
        url: file,
        method: requestMethod,
        data: requestData,
        dataType: 'json',
        success: result,
        error: function(xhr) {
            if(xhr.status == 500) {
                console.error(xhr.responseText);
            } else if(xhr.status != 400) {
                openModal(xhr.responseText);
            }
        }
    });
}

// LOCAL STORAGE
function loadLocalStorage(data) {
    let cookie = [];
    if(localStorage.getItem(data) != null) {
        cookie = JSON.parse(localStorage.getItem(data));
    }
    return cookie;
}

function updateLocalStorage(data, cookie) {
    localStorage.setItem(cookie, JSON.stringify(data));
}

// CART NUMBER
function printCartNumber() {
    let cartDevices = loadLocalStorage('cart');
    var numberOfDevices = 0;
    for(let i in cartDevices) {
        numberOfDevices += cartDevices[i].quantity;
    }
    $('#cartNumber').html(numberOfDevices);
}

// SIDENAV
const sideNavOpenDuration = 200;
function closeSideNav() {
    $('#sideNavContent').css('transform', 'translateX(-100%)');
    setTimeout(function() {
        $('#sideNav').fadeOut('fast');
    }, sideNavOpenDuration);
}