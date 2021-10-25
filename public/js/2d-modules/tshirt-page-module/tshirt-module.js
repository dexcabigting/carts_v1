$(document).ready(function(){

  var TSHIRT_TYPE_ID = "tshirttype",
  IMG_MODULE_SELECTOR = "img[name=tshirtview]",
  NAVIGATION_CONTAINER_CLASS = "nav-container-class",
  // Selectors
  
  ID_SELECTOR = "#",
  CLASS_SELECTOR = ".",
  HIDDEN = "hidden",
  SRC_SELECTOR = "src",
  
  // Events
  CHANGE_EVENT = "change";
  
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

function _attachEvents(){
  _attachEvent(
      _getIdSelector(TSHIRT_TYPE_ID),
      CHANGE_EVENT,
      _onClickImg
  );
}

// Public Methods

function _initializeFunctions(){
  $(_getClassSelector(NAVIGATION_CONTAINER_CLASS)).removeClass(HIDDEN);
  _attachEvents();
}

_initializeFunctions();

});