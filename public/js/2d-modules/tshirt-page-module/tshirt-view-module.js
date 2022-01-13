// Variables

var DATA_ORIGINAL_TITLE = "data-original-title",
FLIPBACK_ID = "flipback",
TSHIRT_TYPE_ID = "tshirttype",
TSHIRT_FACING_ID = "tshirtFacing",

// Selectors

ID_SELECTOR = "#",
CLASS_SELECTOR = ".",
SRC_SELECTOR = "src",

// Events
CLICK_EVENT = "click",
CHANGE_EVENT = "change",

// Titles
SHOW_FRONT_VIEW_TITLE = "Show Front View",
SHOW_BACK_VIEW_TITLE = "Show Back View",

// Private variables
NULL = null,
FALSE = false,
TRUE = true,

_valueSelect = NULL,
_savedFrontCanvas = NULL,
_savedBackCanvas = NULL,
_isFrontCanvas = TRUE;

// Private Methods

function _getIdSelector(selectorID){
    return ID_SELECTOR + selectorID;
}

function _getClassSelector(selectorClass){
    return CLASS_SELECTOR + selectorClass;
}

function _attachEvent(selector, selectorEvent, callback){

    var callBackFunction = $(selector).on(selectorEvent, callback);

    return callBackFunction;
}

// Event Methods

function _getShirtValue(e){
    _valueSelect = $(this).val();
}

function _renderShirtChanges(sender, frontImgUrl, backImgUrl){
    if (sender.attr(DATA_ORIGINAL_TITLE) == SHOW_BACK_VIEW_TITLE 
    || sender.attr(DATA_ORIGINAL_TITLE) == undefined) {

        sender.attr(DATA_ORIGINAL_TITLE, SHOW_FRONT_VIEW_TITLE);	
        $(_getIdSelector(TSHIRT_FACING_ID)).attr(SRC_SELECTOR,backImgUrl);
        frontJsonCanvas = JSON.stringify(canvas);

        _isFrontCanvas = FALSE;

        _savedFrontCanvas = frontJsonCanvas;

        canvas.clear();

        try
        {
            JSON.parse(backJsonCanvas);
            canvas.loadFromJSON(backJsonCanvas);
        }
        catch(e)
        {
            // console.log(e);
        }
    
    } else {

        sender.attr(DATA_ORIGINAL_TITLE, SHOW_BACK_VIEW_TITLE);		
        $(_getIdSelector(TSHIRT_FACING_ID)).attr(SRC_SELECTOR,frontImgUrl);		
        backJsonCanvas = JSON.stringify(canvas);

        _isFrontCanvas = TRUE;

        _savedBackCanvas = backJsonCanvas;

        canvas.clear();

        try
        {
            JSON.parse(frontJsonCanvas);
            canvas.loadFromJSON(frontJsonCanvas);			           
        }
        catch(e)
        {
            // console.log(e);
        }
    }	
}

function _onCLickFlipBack(){
    var baseUrlLastIndex = _valueSelect.indexOf("images");
    var imgUrlStartingIndex = _valueSelect.indexOf("images");
    
    baseUrl = _valueSelect.substr(0, baseUrlLastIndex); 
    imgUrl = _valueSelect.substr(imgUrlStartingIndex); 

    if (imgUrl === "images/2d-img/jersey3.png")
        _renderShirtChanges($(this),baseUrl + "images/2d-img/jersey3.png",baseUrl + "images/2d-img/jersey4back.png");
    else if (imgUrl === "images/2d-img/ALLREDFront.PNG")
        _renderShirtChanges($(this),baseUrl + "images/2d-img/ALLREDFront.PNG",baseUrl + "images/2d-img/ALLREDback.PNG");
    else if (imgUrl === "images/2d-img/Design1front.png")
        _renderShirtChanges($(this),baseUrl + "images/2d-img/Design1front.png",baseUrl + "images/2d-img/Design1back.png");  
    else if (imgUrl === "images/2d-img/RedFront.png")
    _renderShirtChanges($(this),baseUrl + "images/2d-img/RedFront.png",baseUrl + "images/2d-img/RedBack.png");
    else if (imgUrl === "images/2d-img/lineFront.png")
        _renderShirtChanges($(this),baseUrl + "images/2d-img/lineFront.png",baseUrl + "images/2d-img/lineback.png");
    else if (imgUrl === "images/2d-img/Stripeblack.png")
    _renderShirtChanges($(this),baseUrl + "images/2d-img/Stripeblack.png",baseUrl + "images/2d-img/Stripeblackback.png");
    else if (imgUrl === "images/2d-img/newfd.png")
        _renderShirtChanges($(this),baseUrl + "images/2d-img/newfd.png",baseUrl + "images/2d-img/newbd.png");    
    else if (imgUrl === "images/2d-img/newtsf.png")
    _renderShirtChanges($(this),baseUrl + "images/2d-img/newtsf.png",baseUrl + "images/2d-img/newtsb.png");
    else if (imgUrl === "images/2d-img/jacketfront.png")
    _renderShirtChanges($(this),baseUrl + "images/2d-img/jacketfront.png",baseUrl + "images/2d-img/jacketback.png");
    

    canvas.renderAll();

    setTimeout(function() {
        canvas.calcOffset();
    },200);	   
}

function _attachEvents(){
    _attachEvent(
        _getIdSelector(TSHIRT_TYPE_ID),
        CHANGE_EVENT,
        _getShirtValue
    );

    _attachEvent(
        _getIdSelector(FLIPBACK_ID),
        CLICK_EVENT,
        _onCLickFlipBack
    );
}

function _renderCanvas(currentCanvas){
    
    var convertedCanvas = JSON.stringify(currentCanvas);

    if(_isFrontCanvas)
        _savedFrontCanvas = convertedCanvas;
    else
        _savedBackCanvas  = convertedCanvas;
}

// Public Methods

function _initializeFunctions(){
    _valueSelect = $(_getIdSelector(TSHIRT_TYPE_ID)).val();
    _attachEvents();
}

_initializeFunctions();