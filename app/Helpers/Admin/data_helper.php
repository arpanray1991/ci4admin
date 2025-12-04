<?php

    use App\Models\Admin\UiBookmarkModel;
    use App\Models\Admin\ScopesModel;

    if (!function_exists('getUiBookmark')) {
        function getUiBookmark($adminUserId, $slug){
            $uiBookmarkModel = new UiBookmarkModel();
            $uiBookmarkData = $uiBookmarkModel->where('grid_slug', $slug)
                                              ->where('admin_user_id', $adminUserId)
                                              ->first();
            return $uiBookmarkData;
        }
    }

    if (!function_exists('getStatusOption')) {
        function getStatusOption(){
            $statusOptions = [
                '' => 'Select Status',
                '1' => 'Active',
                '2' => 'Inactive',
            ];
            return $statusOptions;
        }
    }

    function getScopeFromSession() {
        if (session()->has('scope')) {
            return session()->get('scope');
        } else {
            return "Undefine Scope";
        }
    }

    function checkModuleInScope($module)
    {
        if (checkSuperAdmin()) { 
            return true; 
        }

        if (session()->has('scope')) {
            $scope = session()->get('scope');

            $scopesModel = new ScopesModel();
            $scopesData = $scopesModel->where('id', $scope)->first();

            $functionality = json_decode($scopesData['functionality']);
            foreach ($functionality as $item) {
                if ($module == $item->module_name) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    function checkSuperAdmin()
    {
        return session()->has('scope') && session()->get('scope') == 3;
    }

    function checkActionInScope($module, $action) 
    {
        if (checkSuperAdmin()) { 
            return true; 
        }

        if (session()->has('scope')) {
            $scope = session()->get('scope');
            $scopesModel = new ScopesModel();
            $scopesData = $scopesModel->where('id', $scope)->first();
            $functionality = json_decode($scopesData['functionality']);
            $action_array = [];
            foreach ($functionality as $item) {
                if (strtolower($module) == strtolower($item->module_name)) {
                    $actions = explode(',', $item->module_action);
                    foreach ($actions as $act) {
                        $action_array[] = strtolower(trim($act));
                    }
                }
            }
            return in_array(strtolower($action), $action_array);
        }
        return false;
    }

?>