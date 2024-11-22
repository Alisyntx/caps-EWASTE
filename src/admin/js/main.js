// import modules
import DeletionCty from "./component/categoryModules/DeletionCty.js";
import AddItemCty from "./component/categoryModules/AddItemCty.js";
import EditItem from "./component/categoryModules/EditItem.js";
import CheckItmPoints from "./component/categoryModules/CheckItmPoints.js";
import DeletionItems from "./component/categoryModules/DeletionItems.js";
import RcyPendings from "./component/categoryModules/RcyPendings.js";
import addCatalogs from "./component/redeemModules/addCtg.js";
import AddItemCtg from "./component/redeemModules/AddItemCtg.js";
import DeletionCtg from "./component/redeemModules/DeletionCtg.js";
import EditItemCtg from "./component/redeemModules/EditItemCtg.js";
import DelItemCtg from "./component/redeemModules/DelItemCtg.js";
import ShowRcntAct from "./component/dashboardModules/showRcntAct.js";
import RwdPendings from "./component/redeemModules/RwdPendings.js";
import declineRcy from "./component/categoryModules/declineRcy.js";
import DeclineRwd from "./component/redeemModules/DeclineRwd.js";
import genReport from "./component/genReportModules/genReport.js";
import userManagement from "./component/userManage/userManage.js";
import auth from "./component/Auth/Auth.js";

$(document).ready(() => {

    const delBtn = ".delCty";
    const modalConId = "#delCty"; // modal container id
    const delFormId = "#delCtyModal"; // form id in modal
    const loadModalDel =
        "../src/admin/components/dialogs/categories/deleteCty.php";
    const delCtyUrl = "../src/admin/php/categories/delCty.php";

    new DeletionCty(delBtn, modalConId, delFormId, loadModalDel, delCtyUrl);

    // this is for inserting item by clicking insert in category
    const addCtyBtn = ".addItemCtyId";
    const modalConAddCty = "#addItemCty";
    const addItemCtyForm = "#addItemCtyForm";
    const loadModalAddCty =
        "../src/admin/components/dialogs/categories/addItemCty.php";
    const addItemCtyUrl = "../src/admin/php/categories/addItemCty.php";

    new AddItemCty(
        addCtyBtn,
        modalConAddCty,
        addItemCtyForm,
        loadModalAddCty,
        addItemCtyUrl
    );

    // this is for edit items
    const editItemsBtn = ".editItems";
    const modalConEditItems = "#editItems";
    const editItemForm = ".editItemsForm";
    const loadItemModal =
        "../src/admin/components/dialogs/categories/editItems.php";
    const editItemUrl = "../src/admin/php/categories/editItem.php";

    new EditItem(
        editItemsBtn,
        modalConEditItems,
        editItemForm,
        loadItemModal,
        editItemUrl
    );

    //this for checking points item
    const checkPointsBtn = ".checkPoints";
    const checkPointsModal = "#editPoints";
    const loadPointsModal =
        "../src/admin/components/dialogs/categories/checkPoints.php";

    new CheckItmPoints(checkPointsBtn, checkPointsModal, loadPointsModal);

    // this is for deleting Items
    const deleteItemsBtn = ".deleteItems";
    const deleteItemsModal = "#delItems";
    const deleteItemsForm = "#delItemForm";
    const loadDelItemsModal =
        "../src/admin/components/dialogs/categories/deleteItem.php";
    const deleteItemUrl = "../src/admin/php/categories/delItem.php";

    new DeletionItems(
        deleteItemsBtn,
        deleteItemsModal,
        deleteItemsForm,
        loadDelItemsModal,
        deleteItemUrl
    );

    // this is for recyclable items pendings

    const acceptRcyBtn = ".acceptRcy";
    const acceptRcyModal = "#acceptRcyItem";
    const acceptRcyForm = "#acceptRcyForm";
    const loadRcyItemModal =
        "../src/admin/components/dialogs/rcyPendings/acceptRcy.php";
    const acceptRcyUrl = "../src/admin/php/rcyPendings/acceptRcy.php";
    new RcyPendings(
        acceptRcyBtn,
        acceptRcyModal,
        acceptRcyForm,
        loadRcyItemModal,
        acceptRcyUrl
    );

    //this is for adding catalog
    const saveFormCtg = "#formSaveCtg";
    const saveUrlCtg = "../src/admin/php/catalogs/addCtg.php";
    const saveCtgHtml = "#ctgHtml";
    new addCatalogs(saveFormCtg, saveUrlCtg, saveCtgHtml);

    //this is for adding item in catalog
    const addItemCtgModalCon = "#addItemCtg";
    const addItemCtgBtn = ".addItemCtgId";
    const addItemCtgModal = "../src/admin/components/dialogs/catalogs/addItemCtg.php";
    const addItemCtgForm = "#addItemCtgForm"
    const addItemCtgUrl = "../src/admin/php/catalogs/addItemCtg.php";
    new AddItemCtg(addItemCtgModalCon, addItemCtgBtn, addItemCtgModal, addItemCtgUrl, addItemCtgForm);
    
    // this is for deleting Ctg
    const delCtgBtn = ".delCtg";
    const delCtgModalCon = "#delCtg"; 
    const delCtgModal =
        "../src/admin/components/dialogs/catalogs/delCtg.php";
    const delCtgForm = "#delCtgForm";
    const delCtgUrl = "../src/admin/php/catalogs/delCtg.php";
    new DeletionCtg(delCtgBtn, delCtgModalCon, delCtgModal, delCtgForm, delCtgUrl);

    // this is for editing items in catalogs
    const editItemCtgBtn = ".editCtgItems";
    const editItemCtgModalCon = "#editItemCtg";
    const editItemCtgModal = "../src/admin/components/dialogs/catalogs/editItemCtg.php";
    const editItemCtgForm = ".editItemsCtgForm";
    const editItemCtgUrl = "../src/admin/php/catalogs/editItemCtg.php";
    new EditItemCtg(editItemCtgBtn, editItemCtgModalCon, editItemCtgModal, editItemCtgForm, editItemCtgUrl);
    
    //this is for deleting items in catalogs
    const delItemCtgBtn = '.deleteCtgItems';
    const delItemCtgModalCon = '#delCtgItems';
    const delItemCtgModal = "../src/admin/components/dialogs/catalogs/delItemCtg.php";
    const delItemCtgForm = "#delItemCtgForm";
    const delItemCtgUrl = "../src/admin/php/catalogs/delItemCtg.php";

    new DelItemCtg(delItemCtgBtn, delItemCtgModalCon, delItemCtgModal, delItemCtgForm, delItemCtgUrl);
    // this is for recyclable items pendings
    const acceptRwdBtn = ".acceptRwd";
    const acceptRwdModal = "#acceptRwdItem";
    const acceptRwdForm = "#acceptRwdForm";
    const loadRwdItemModal =
        "../src/admin/components/dialogs/catalogs/acceptRwd.php";
    const acceptRwdUrl = "../src/admin/php/catalogs/acceptRwd.php";
    new RwdPendings(
        acceptRwdBtn,
        acceptRwdModal,
        acceptRwdForm,
        loadRwdItemModal,
        acceptRwdUrl
    );
    
    // dashboard
    //view recent activities
    const viewRcntBtn = '.viewRcntActBtn';
    const viewRcntModalCon = '#showRcntAct';
    const viewRcntModal = '../src/admin/components/dialogs/dashboard/showRcntAct.php';
    new ShowRcntAct(viewRcntBtn, viewRcntModalCon, viewRcntModal);

    //decline rcy
    const declineRcyBtn = '.declineRcy';
    const declineRcyModal = '#declineRcy';
    const declineRcyForm = '#declineRcyForm';
    const loadDeclineRcyModal = '../src/admin/components/dialogs/rcyPendings/declineRcy.php';
    const declineRcyUrl = '../src/admin/php/rcyPendings/declineRcy.php';
    new declineRcy(declineRcyBtn, declineRcyModal, declineRcyForm, loadDeclineRcyModal, declineRcyUrl);

    //decline rwd
    const declineRwdBtn = '.declineRwd';
    const declineRwdModal = '#declineRwdItem';
    const declineRwdForm = '#declineRwdForm';
    const loaddeclineRwdModal = '../src/admin/components/dialogs/catalogs/declineRwd.php';
    const declineRwdUrl = '../src/admin/php/catalogs/declineRwd.php';
    new DeclineRwd(declineRwdBtn, declineRwdModal, declineRwdForm, loaddeclineRwdModal, declineRwdUrl);

    // generating report 
    const mostlyReportBtn = new genReport('.btn-mostly', 'mostly');
    const allRcyReportBtn = new genReport('.btn-All-items', 'allRcy');
    const allRwdReportBtn = new genReport('.btn-allRwd', 'allRwd');
    const mostlyRwdReportBtn = new genReport('.btn-mostlyRwd', 'mostlyRwd');

    //user management
    const userManageBtn = '.userManage';
    const userManageModal = '#editUser';
    const userManageForm = '#editUserForm';
    const loadManageModal = '../src/admin/components/dialogs/userManage/userManage.php';
    const userManageUrl = '../src/admin/php/userManage/userManage.php';
    const userFetch = '../src/admin/components/fetching/userManagement/userFetch.php';
    new userManagement(userManageBtn, userManageModal, userManageForm, loadManageModal, userManageUrl, userFetch);
    
    //lagout
    const logoutBtn = '.lagout';
    new auth(logoutBtn);

});

    

  
