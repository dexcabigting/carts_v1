// Variables

var UPLOAD_CUSTOM_IMAGE_ID = "upload-custom-image-id",
FILE_UPLOAD_CONTAINER_ID = "file-upload-container-id",
AVATAR_LIST = "avatarlist",

// Selectors

ID_SELECTOR = "#",
CLASS_SELECTOR = ".",

// Events
CLICK_EVENT = "click",
CHANGE_EVENT = "change",

// Private variables
NULL = null;

// Private Methods

function _getIdSelector(selectorID){
    return ID_SELECTOR + selectorID;
}

function _attachEvent(selector, selectorEvent, callback){

    var callBackFunction = $(selector).on(selectorEvent, callback);

    return callBackFunction;
}

// Event Methods

function _onClickUploadImage(){
    var file = $(_getIdSelector(FILE_UPLOAD_CONTAINER_ID)).get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            var imgContainer = "<img style='cursor:pointer;' class='img-polaroid' src='" + reader.result + "'>";

            $(_getIdSelector(AVATAR_LIST)).append(imgContainer);
            
        }

        reader.readAsDataURL(file);
    }
}

function _attachEvents(){

    _attachEvent(
        _getIdSelector(UPLOAD_CUSTOM_IMAGE_ID),
        CLICK_EVENT,
        _onClickUploadImage
    );
}

// Public Methods

function _initializeFunctions(){
    _attachEvents();
}

_initializeFunctions();