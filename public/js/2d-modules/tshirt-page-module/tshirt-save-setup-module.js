var BTN_SAVE_ID = "btn-save",
BTN_GOBACK_ID = "btn-go-back-to-shop-id",
FABRIC_TYPE_ID = "fabrictype",
TSHIRT_TYPE_ID = "tshirttype",
TSHIRT_CONTAINER_ID = "shirtDiv",
TSHIRT_CONTAINER_CLASS = "shirtDiv",
SAVE_TSHIRT_FACING_ID = "tshirtFacing",
PREVIEW_UPLOADED_FILE = "preview-uploaded-files",

CSRF_MODULE = "meta[name=csrf-token]",
BICEP_ID = "bicep-id",
CHEST_ID = "chest-id",
FORM_VALIDATION_ID = "validate-form-id",
HIDDEN_USER_NAME_ID = "hdn-user-name-id",
HIP_ID = "hip-id",
NECK_ID = "neck-id",
SHIRT_LENGTH_ID = "shirt-lenght-id",
SHOULDER_ID = "should-id",
STOMACH_ID = "stomach-id",
WAIST_ID = "waist-id",

SHORT_WAIST_ID = "short-waist-id",
INSEAM_ID = "inseam-id",
OUTSEAM_ID = "outseam-id",

MODAL_BACKGROUND_CLASS = "modal-background-class",
MODAL_BODY_CLASS = "modal-body-class",
USER_NAV_CLASS = "user-nav-class",
CUSTOM_DESIGN_CONTAINER = "custom-design-container",
UPLOADED_FILE = "img-upload-polaroid",

// Attributes
BACKGROUND_COLOR = "background-color",
CONTENT = "content",
HIDDEN = "hidden",
SAVE_DATA_ORIGIN_TITLE = "data-original-title",
SELECTED = ":selected",

// Selectors

CLASS_SELECTOR = ".",
ID_SELECTOR = "#",
SRC_SELECTOR = "src",

// Title
SAVE_SHOW_BACK_VIEW = "Show Back View",
SAVE_SHOW_FRONT_VIEW = "Show Front View",

//template
SUBMIT_FAKE_BUTTON_TEMPLATE = '<input type ="submit">'

// Events
CLICK_EVENT = "click",
CHANGE_EVENT = "change",

EMPTY_STRING = "",
POST = "POST",

_selectedFabricType = "Spandex",
_selectedTshirtType = "Short Sleeve Shirts",
_baseSixtyFourPDF = EMPTY_STRING;


_isSave = FALSE;
// API Methods

function _insertShirtSetup(data){
    $.ajax({
        url: "/api/tshirt",
        type: POST,
        data: data,
        success: function(){
            $(_getClassSelector(MODAL_BACKGROUND_CLASS)).removeClass(HIDDEN);
            $(_getClassSelector(MODAL_BODY_CLASS)).removeClass(HIDDEN);
            
        }
    });
}

// Callback Methods

function _insertShirtSetupSaveCompleted(){

    var valueSelect = $(_getIdSelector(TSHIRT_TYPE_ID)).val();
        
    var baseUrlLastIndex = valueSelect.indexOf("images");
    
    baseUrl = valueSelect.substr(0, baseUrlLastIndex); 

    window.location.href = baseUrl + "my-reservations";
}

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

function _getFieldTextValue(selector){
    return $(_getIdSelector(selector)).val();
}

function _onClickFabricType(e){
    var sender = $(this),
        selectedFabric = sender.find(SELECTED).text();

    _selectedFabricType = selectedFabric;
}

function _onClickTshirtType(e){
    var sender = $(this),
        selectedTshirt = sender.find(SELECTED).text();

    _selectedTshirtType = selectedTshirt;

}

function _validateInputFields(){
    var myForm = $(_getIdSelector(FORM_VALIDATION_ID))
    ,formValidator = myForm[0].checkValidity();

    if (!formValidator){
        $(SUBMIT_FAKE_BUTTON_TEMPLATE).hide().appendTo(myForm).click().remove();
        return false;
    }

    return true;
}



function _onClickBtnSave(){
    if(!_validateInputFields()) 
        return;

    if(!_isSave){

        let customContainer = $(_getClassSelector(CUSTOM_DESIGN_CONTAINER)),
        customContainerAttribute = customContainer.attr(HIDDEN);

        let isCustom = (typeof (customContainerAttribute) !== typeof undefined
                    && customContainerAttribute !== false);

        if(!isCustom)
            _createtshirtPDF();

        setTimeout(function() {
            var token = $(CSRF_MODULE).attr(CONTENT);
            
            var tshirtSetup = {};

            var jersey_measurements = {
                Neck: _getFieldTextValue(NECK_ID),
                Chest: _getFieldTextValue(CHEST_ID),
                Stomach: _getFieldTextValue(STOMACH_ID),
                Waist: _getFieldTextValue(WAIST_ID),
                Hip: _getFieldTextValue(HIP_ID),
                ShirtLength: _getFieldTextValue(SHIRT_LENGTH_ID),
                Shoulder: _getFieldTextValue(SHOULDER_ID),
                Bicep: _getFieldTextValue(BICEP_ID)
            };
            
            var short_measurements = {
                Waist: _getFieldTextValue(SHORT_WAIST_ID),
                Inseam: _getFieldTextValue(INSEAM_ID),
                Outseam: _getFieldTextValue(OUTSEAM_ID)
            };
   
            if(!isCustom){
                var tshirtColor = $(_getIdSelector(TSHIRT_CONTAINER_ID)).css(BACKGROUND_COLOR);

                tshirtSetup = {
                    customer_name: _getFieldTextValue(HIDDEN_USER_NAME_ID),
                    tshirt_front: _savedFrontCanvas,
                    tshirt_back: _savedBackCanvas,
                    tshirt_jersey_measurements: JSON.stringify(jersey_measurements || {}),
                    tshirt_short_measurements: JSON.stringify(short_measurements || {}),
                    tshirt_fabric: JSON.stringify(_selectedFabricType),
                    tshirt_type: JSON.stringify(_selectedTshirtType),
                    tshirt_color: JSON.stringify(tshirtColor),
                    tshirt_pdf: JSON.stringify(_baseSixtyFourPDF),
                    _token: token
                };

                _insertShirtSetup(tshirtSetup);
            }
            else {

                var tempDocs = new jsPDF();

                setTimeout(function() {
                    html2canvas(document.querySelector(_getIdSelector(PREVIEW_UPLOADED_FILE))).then(uploadCanvas => {

                        function convertCanvasToImage(c)
                        {
                            var image = new Image();
                            image.src = c.toDataURL("image/jpeg");
                            tempDocs.addImage(image.src, 'JPEG', 10, 10);

                            tshirtSetup = {
                                customer_name: _getFieldTextValue(HIDDEN_USER_NAME_ID),
                                tshirt_front: JSON.stringify({}),
                                tshirt_back: JSON.stringify({}),
                                tshirt_jersey_measurements: JSON.stringify(jersey_measurements || {}),
                                tshirt_short_measurements: JSON.stringify(short_measurements || {}),
                                tshirt_fabric: JSON.stringify({}),
                                tshirt_type: JSON.stringify({}),
                                tshirt_color: JSON.stringify({}),
                                tshirt_pdf: JSON.stringify(tempDocs.output("datauristring")),
                                _token: token
                            };
                            
                            _insertShirtSetup(tshirtSetup);

                            return image;
                        }
                        convertCanvasToImage(uploadCanvas);
                    });
                },200); 

            }

        },2600);	

         _isSave = TRUE;

    }
}

function _createtshirtPDF(){
    var valueSelect = $(_getIdSelector(TSHIRT_TYPE_ID)).val();

    var baseUrlLastIndex = valueSelect.indexOf("images");
    var imgUrlStartingIndex = valueSelect.indexOf("images");
    
    baseUrl = valueSelect.substr(0, baseUrlLastIndex); 
    imgUrl = valueSelect.substr(imgUrlStartingIndex); 

    if (imgUrl === "images/2d-img/jersey3.png")
        _flipTshirt($(_getIdSelector("flipback")),baseUrl + "images/2d-img/jersey3.png",baseUrl + "images/2d-img/jersey4back.png");
    else if (imgUrl === "images/2d-img/ALLREDFront.PNG")
        _flipTshirt($(_getIdSelector("flipback")),baseUrl + "images/2d-img/ALLREDFront.PNG",baseUrl + "images/2d-img/ALLREDback.PNG");
    else if (imgUrl === "images/2d-img/Design1front.png")
        _flipTshirt($(_getIdSelector("flipback")),baseUrl + "images/2d-img/Design1front.png",baseUrl + "images/2d-img/Design1back.png");
    else if (imgUrl === "images/2d-img/RedFront.png")
        _flipTshirt($(_getIdSelector("flipback")),baseUrl + "images/2d-img/RedFront.png",baseUrl + "images/2d-img/RedBack.png"); 
    else if (imgUrl === "images/2d-img/lineFront.png")
        _flipTshirt($(_getIdSelector("flipback")),baseUrl + "images/2d-img/lineFront.png",baseUrl + "images/2d-img/lineback.png"); 
    else if (imgUrl === "images/2d-img/Stripeblack.png")
        _flipTshirt($(_getIdSelector("flipback")),baseUrl + "images/2d-img/Stripeblack.png",baseUrl + "images/2d-img/Stripeblackback.png"); 
    else if (imgUrl === "images/2d-img/jacketfront.png")
        _flipTshirt($(_getIdSelector("flipback")),baseUrl + "images/2d-img/jacketfront.png",baseUrl + "images/2d-img/jacketback.png"); 
}

function _flipTshirt(sender, frontImgUrl, backImgUrl){
    
    var pdf = new jsPDF();
    pdf.setFontSize(20);
    
    if (sender.attr(SAVE_DATA_ORIGIN_TITLE) == SAVE_SHOW_BACK_VIEW 
    || sender.attr(SAVE_DATA_ORIGIN_TITLE) == undefined) {
        _frontCanvas(pdf).then(() => {
            return new Promise(next => {
                setTimeout(function() {

                    sender.attr(SAVE_DATA_ORIGIN_TITLE, SAVE_SHOW_FRONT_VIEW);	
                    $(_getIdSelector(SAVE_TSHIRT_FACING_ID)).attr(SRC_SELECTOR,backImgUrl);
                    
                    canvas.clear();
            
                    try
                    {
                        JSON.parse(_savedBackCanvas);
                        canvas.loadFromJSON(_savedBackCanvas);
                        next();
                    }
                    catch(e)
                    {
                        console.log(e);
                    }

                },1000);
            });
        }).then(() => {
            return _backCanvas(pdf);
        }).then(() => {
            setTimeout(function(){
                var milliSeconds = Date.now();
                pdf.save("Custom-Shirt-" + milliSeconds + ".pdf");
                _baseSixtyFourPDF = pdf.output("datauristring");
            },300);
        });
    }
    else{
        _backCanvas(pdf).then(() => {
            return new Promise(next => {
                    sender.attr(SAVE_DATA_ORIGIN_TITLE, SAVE_SHOW_BACK_VIEW);		
                    $(_getIdSelector(SAVE_TSHIRT_FACING_ID)).attr(SRC_SELECTOR,frontImgUrl);		
            
                    // canvas.clear();
            
                    try
                    {
                        JSON.parse(_savedFrontCanvas);
                        canvas.loadFromJSON(_savedFrontCanvas);	
                        next();		           
                    }
                    catch(e)
                    {
                        console.log(e);
                    }
            });
        }).then(() =>{
            setTimeout(function() {
                return  _frontCanvas(pdf);
            },100);
        }).then(() => {
            setTimeout(function(){
                var milliSeconds = Date.now();
                pdf.save("Custom-Shirt-" + milliSeconds + ".pdf");
                _baseSixtyFourPDF = pdf.output("datauristring");
            },1000);
        });
    }
        
    // canvas.renderAll();
    // canvas.calcOffset();	
}

function _frontCanvas(pdf){
    return html2canvas(document.querySelector(_getIdSelector(TSHIRT_CONTAINER_ID))).then(canvas => {

        function convertCanvasToImage(c)
        {
            var image = new Image();
            image.src = c.toDataURL("image/jpeg");
            pdf.addImage(image.src, 'JPEG', 30, 5, 145, 145);
            return image;
        }
        convertCanvasToImage(canvas);
    });

}

function _backCanvas(pdf){

    return html2canvas(document.querySelector(_getIdSelector(TSHIRT_CONTAINER_ID))).then(canvas => {

        function convertCanvasToImage(c)
        {
            var image = new Image();
            image.src = c.toDataURL("image/jpeg");
            pdf.addImage(image.src, 'JPEG', 30, 150, 145, 145);
            return image;
        }
        convertCanvasToImage(canvas);
    });
    
}

function _attachEvents(){
    _attachEvent(
        _getIdSelector(BTN_SAVE_ID),
        CLICK_EVENT,
        _onClickBtnSave
    );

    _attachEvent(
        _getIdSelector(FABRIC_TYPE_ID),
        CLICK_EVENT,
        _onClickFabricType
    );

    _attachEvent(
        _getIdSelector(TSHIRT_TYPE_ID),
        CLICK_EVENT,
        _onClickTshirtType
    );

    _attachEvent(
        _getIdSelector(BTN_GOBACK_ID),
        CLICK_EVENT,
        _insertShirtSetupSaveCompleted
    );
}

// Public Methods

function _initializeFunctions(){
    $(_getClassSelector(USER_NAV_CLASS)).removeClass(HIDDEN);
    _attachEvents();
}

_initializeFunctions();
