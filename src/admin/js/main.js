// import modules
import DeletionCty from "./component/DeletionCty.js";
import AddItemCty from "./component/AddItemCty.js";
import EditItem from "./component/EditItem.js";
import CheckItmPoints from "./component/checkItmPoints.js";
import DeletionItems from "./component/DeletionItems.js";

$(document).ready(()=>{
    const delBtn = '.delCty';
    const modalConId = '#delCty';  // modal container id
    const delFormId = '#delCtyModal'; // form id in modal
    const loadModalDel = '../src/admin/components/dialogs/categories/deleteCty.php';
    const delCtyUrl = '../src/admin/php/categories/delCty.php';

    new DeletionCty(delBtn,modalConId,delFormId,loadModalDel,delCtyUrl);

    // this is for inserting item by clicking insert in category
    const addCtyBtn = '.addItemCtyId';
    const modalConAddCty = '#addItemCty';
    const addItemCtyForm = '#addItemCtyForm';
    const loadModalAddCty = '../src/admin/components/dialogs/categories/addItemCty.php';
    const addItemCtyUrl = '../src/admin/php/categories/addItemCty.php';

    new AddItemCty(addCtyBtn,modalConAddCty,addItemCtyForm,loadModalAddCty,addItemCtyUrl);

    // this is for edit items
    const editItemsBtn = '.editItems';
    const modalConEditItems = '#editItems';
    const editItemForm = '.editItemsForm';
    const loadItemModal = '../src/admin/components/dialogs/categories/editItems.php'
    const editItemUrl = '../src/admin/php/categories/editItem.php';

    new EditItem(editItemsBtn,modalConEditItems,editItemForm,loadItemModal,editItemUrl);

    //this for checking points item
    const checkPointsBtn = '.checkPoints';
    const checkPointsModal = '#editPoints';
    const loadPointsModal = '../src/admin/components/dialogs/categories/checkPoints.php';

    new CheckItmPoints(checkPointsBtn,checkPointsModal,loadPointsModal);

    // this is for deleting Items
    const deleteItemsBtn = '.deleteItems';
    const deleteItemsModal = '#delItems';
    const deleteItemsForm = '#delItemForm';
    const loadDelItemsModal = '../src/admin/components/dialogs/categories/deleteItem.php';
    const deleteItemUrl = '../src/admin/php/categories/delItem.php';
  
     new DeletionItems(deleteItemsBtn,deleteItemsModal,deleteItemsForm,loadDelItemsModal,deleteItemUrl);
});
