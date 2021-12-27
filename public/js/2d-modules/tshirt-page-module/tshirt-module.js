$(document).ready(function(){

  var TSHIRT_TYPE_ID = "tshirttype",
  IMG_MODULE_SELECTOR = "img[name=tshirtview]",
  NAVIGATION_CONTAINER_CLASS = "nav-container-class",
  BORDER_DANGER = "border-danger",

  BICEP_ID = "bicep-id",
  CHEST_ID = "chest-id",
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
  // Selectors
  
  ID_SELECTOR = "#",
  CLASS_SELECTOR = ".",
  HIDDEN = "hidden",
  SRC_SELECTOR = "src",
  NULL = null,
  
  // Events
  CHANGE_EVENT = "change",
  KEYUP_EVENT = "keyup";
  
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

function _onClickImg(){
  $(IMG_MODULE_SELECTOR).attr(SRC_SELECTOR,$(this).val());
}

function _checkInputNumber(e) {
  var sender = $(this);
  var elementId = e.target.id;
  var elementContainer = $(_getIdSelector(elementId));
  var isValidNumber = _isNumberAndMaxLength(sender);

  if(!isValidNumber) {
    elementContainer.val(NULL);
    elementContainer.addClass(BORDER_DANGER);
  }
  else
    elementContainer.removeClass(BORDER_DANGER);
}

function _isNumberAndMaxLength(sender) {
  return !isNaN(sender.val()) && sender.val().length <= 3;
}

function _attachEvents(){
  _attachEvent(
      _getIdSelector(TSHIRT_TYPE_ID),
      CHANGE_EVENT,
      _onClickImg
  );

  _attachEvent(
    _getIdSelector(BICEP_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(CHEST_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(HIDDEN_USER_NAME_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(HIP_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(NECK_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(SHIRT_LENGTH_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(SHOULDER_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(STOMACH_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(WAIST_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(SHORT_WAIST_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(INSEAM_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
  _attachEvent(
    _getIdSelector(OUTSEAM_ID),
    KEYUP_EVENT,
    _checkInputNumber
  );
}

// Public Methods

function _initializeFunctions(){
  $(_getClassSelector(NAVIGATION_CONTAINER_CLASS)).removeClass(HIDDEN);
  $(".flex.justify-between.h-16").find("div.hidden").removeClass(HIDDEN);
  _attachEvents();
}

_initializeFunctions();

});