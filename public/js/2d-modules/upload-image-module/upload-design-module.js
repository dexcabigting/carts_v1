// Variables

var FILE_UPLOAD_CONTAINER_ID = "uploaded-preview-image",
PREVIEW_UPLOADED_FILE = "preview-uploaded-files",

CUSTOM_DESIGN_CONTAINER = "custom-design-container",
UPLOAD_DESIGN_CONTAINER = "upload-design-container",
SUBMIT_FILE_TOGGLE_CLASS = "submit-file-toggle",

// Selectors

ID_SELECTOR = "#",
CLASS_SELECTOR = ".",

// Events
CLICK_EVENT = "click",
CHANGE_EVENT = "change",

// Private variables
HIDDEN = "hidden",
NULL = null;

// Private Methods

function _getIdSelector(selectorID){
    return ID_SELECTOR + selectorID;
}

function _getClassSelector(selectorID){
    return CLASS_SELECTOR + selectorID;
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
        
        var newCanvas = document.getElementById(PREVIEW_UPLOADED_FILE);
        
        var newContext = newCanvas.getContext("2d");

        var reader = new FileReader();

        reader.onload = function(event){

            var image = new Image();

            image.onload = function(){
                newCanvas.width = image.width;
                newCanvas.height = image.height;
                newContext.drawImage(image,0,0);
            }

            image.src = event.target.result;
        }

        reader.readAsDataURL(file);
    }
}

function _onUploadToggle(){
    let customContainer = $(_getClassSelector(CUSTOM_DESIGN_CONTAINER)),
        uploadDesignContainer = $(_getClassSelector(UPLOAD_DESIGN_CONTAINER)),
        customContainerAttribute = customContainer.attr(HIDDEN);
        
        if(typeof (customContainerAttribute) !== typeof undefined
            && customContainerAttribute !== false){
            customContainer.removeAttr(HIDDEN);
            uploadDesignContainer.attr(HIDDEN,HIDDEN);
        }
        else{
            uploadDesignContainer.removeAttr(HIDDEN);
            customContainer.attr(HIDDEN,HIDDEN);
        }
}

function _attachEvents(){

    _attachEvent(
        _getIdSelector(FILE_UPLOAD_CONTAINER_ID),
        CHANGE_EVENT,
        _onClickUploadImage
    );

    _attachEvent(
        _getClassSelector(SUBMIT_FILE_TOGGLE_CLASS),
        CLICK_EVENT,
        _onUploadToggle
    );
    
}

// Public Methods

function _initializeFunctions(){
    _attachEvents();
}

_initializeFunctions();