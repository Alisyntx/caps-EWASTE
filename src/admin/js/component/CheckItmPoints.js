class CheckItmPoints{
    constructor(checkPointsBtn,checkPointsModal,loadPointsModal){
        this.checkPointsBtn = checkPointsBtn;
        this.checkPointsModal = checkPointsModal; 
        this.loadPointsModal = loadPointsModal;
        this.pointsId = null;
        
        this.letsBindEvents();
    }

    letsBindEvents(){
        $(document).on('click', this.checkPointsBtn,(e)=>this.loadModalPoints(e))
    };

    loadModalPoints(e){
        e.preventDefault();
        this.pointsId = $(e.currentTarget).attr('id');
        $.post(this.loadPointsModal, {getId : this.pointsId}, (response)=>{
            $(this.checkPointsModal).html(response);
        });
    };
}
export default CheckItmPoints;