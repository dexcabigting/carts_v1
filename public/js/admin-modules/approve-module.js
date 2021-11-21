$(document).ready(function(){
    let APPROVE_MODAL_ID = "approve-modal",
        BTN_OPEN_MODAL_ID = "btn-open-modal",
        BTN_CLOSE_MODAL_ID = "btn-close",
        BTN_APPROVE_MODAL_ID = "btn-approve",
        BTN_EXPORT_PDF = "btn-export-pdf",

        ID_HOLDER = "id-holder",
        NOTE_ID = "note",
        PRICE_ID = "price",
        ESTIMATE_DELIVERY_ID = "estimate-delivery",
        // Selectors
        
        ID_SELECTOR = "#",
        CLASS_SELECTOR = ".",
        EMPTY_STRING = "",
        PUT = "put",
        
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

    function _onClickToggleApproveModal(){
        let sender = $(this),
            id = sender.data("id"),
            approveContainer = $(_getIdSelector(APPROVE_MODAL_ID)),
            modalAttr = approveContainer.attr(HIDDEN);
        
        if (typeof modalAttr !== typeof undefined 
            && modalAttr !== false){
            approveContainer.removeAttr(HIDDEN);

            $(_getIdSelector(ID_HOLDER)).val(id);
        }
        else
            $(_getIdSelector(APPROVE_MODAL_ID)).attr(HIDDEN,HIDDEN);

        _resetModule();
    }

    function _onClickApprove(){

        let approveCustomTShirt = {
            id: $(_getIdSelector(ID_HOLDER)).val(),
            custom_note: $(_getIdSelector(NOTE_ID)).val().trim(),
            custom_price: $(_getIdSelector(PRICE_ID)).val(),
            custom_estimate_delivery: $(_getIdSelector(ESTIMATE_DELIVERY_ID)).val(),
            is_approve: true
        };

        $.ajax({
            url: "/api/tshirt",
            type: PUT,
            data: approveCustomTShirt,
            success: function(){
                _resetModule();
                $(_getIdSelector(APPROVE_MODAL_ID)).attr(HIDDEN,HIDDEN);
                window.location = "/products/customerlist";
            }
        });

    }

    function _onExportToPDF(){
        var exportData = $(this).data("value");
        
        const downloadLink = document.createElement("a");
        const fileName = "Custom-Details.pdf";
        downloadLink.href = exportData;
        downloadLink.download = fileName;
        downloadLink.click();
    }

    function _attachEvents(){

        _attachEvent(
            _getClassSelector(BTN_OPEN_MODAL_ID),
            CLICK_EVENT,
            _onClickToggleApproveModal
        );

        _attachEvent(
            _getIdSelector(BTN_CLOSE_MODAL_ID),
            CLICK_EVENT,
            _onClickToggleApproveModal
        );

        _attachEvent(
            _getIdSelector(BTN_APPROVE_MODAL_ID),
            CLICK_EVENT,
            _onClickApprove
        );

        _attachEvent(
            _getClassSelector(BTN_EXPORT_PDF),
            CLICK_EVENT,
            _onExportToPDF
        );
    }

    function _resetModule(){
        $(_getIdSelector(NOTE_ID)).val(EMPTY_STRING);
        $(_getIdSelector(PRICE_ID)).val(EMPTY_STRING);
        $(_getIdSelector(ESTIMATE_DELIVERY_ID)).val(EMPTY_STRING);
    }

    // Public Methods

    function _initializeFunctions(){
        _attachEvents();
    }

    _initializeFunctions();



});