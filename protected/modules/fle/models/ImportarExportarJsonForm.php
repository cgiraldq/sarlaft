<?php

/**
 * Esta clase Define el modelo del formulario Consultas
 * para la consulta de conectividad
 * 
 * @package Telnet
 */
class ImportarExportarJsonForm extends CFormModel {

    //campos del modelo
    public $json;

    

    /**
     * @return arreglo de las diferentes validaciones del modelo
     */
    public function rules() {
        return array(
                // username and password are required
                // array('json', 'required', 'message' => 'Este campo es obligatorio'),
        );
    }

    /**
     * @return arreglo personalizado con las etiquetas de los campos
     * (name => label)
     */
    public function attributeLabels() {
        return array(
            'json' => 'Permisos JSON',
        );
    }

    #este metodo permite realizar la prueba de conexion telnet a un host remoto
    /**
     * 
     * @param array $options
     * @return array
     */

    public function importar() {
        try {
            /**
             * Importar
             */
            $json = json_decode(json_encode(json_decode($this->json)));
            $aciones_creados = array();
            $controllers_creados = array();
            $msg = '';
            foreach ($json as $rol => $arrPermisos) {
                if ($rol != '') {
                    foreach ($arrPermisos as $controller => $arrAcciones) {
                        $controller = strtolower($controller);
                        /**
                         * Crear la controlador si no existe
                         */
                        $modelController = Controllers::model()->find(array('condition' => 'controller=:controller',
                            'params' => array(':controller' => (string) $controller)));
                        if (!$modelController && $controller != '') {
                            $modelController = new Controllers();
                            $modelController->description = $controller;
                            $modelController->controller = $controller;
                            $modelController->save();
                            $controllers_creados[] = $controller;
                        }
                        foreach ($arrAcciones as $action) {
                            /**
                             * Crear El CRUD (Acción) si no existe
                             */
                            $modelAction = Action::model()->find(array('condition' => 'action=:action',
                                'params' => array(':action' => (string) $action)));
                            if (!$modelAction && $action != '') {
                                $modelAction = new Action();
                                $modelAction->description = $action;
                                $modelAction->action = $action;
                                $modelAction->save();
                                $aciones_creados[] = $action;
                            }
                            /**
                             * Asociar el crud a la transacción si no existe
                             */
                            $modelPermissionsRoles = PermissionsRoles::model()->find(array('condition' => 'rol=:rol AND controller=:controller AND action=:action',
                                'params' => array(':rol' => $rol,
                                    ':controller' => $controller,
                                    ':action' => $action)));
                            if (!$modelPermissionsRoles) {
                                $modelPermissionsRoles = new PermissionsRoles();
                                $modelPermissionsRoles->rol = $rol;
                                $modelPermissionsRoles->controller = $controller;
                                $modelPermissionsRoles->action = $action;
                                $modelPermissionsRoles->save();
                            }
                        }
                    }
                }
                if (count($aciones_creados) > 0) {
                    $msg .= '<strong>Acciones: </strong>' . implode(', ', $aciones_creados) . '<br>';
                }
                if (count($controllers_creados) > 0) {
                    $msg .= '<strong>Transacciones: </strong>' . implode(', ', $controllers_creados) . '<br>';
                }
            }
            if ($msg != '') {
                Yii::app()->user->setFlash('success', $msg);
            }
        } catch (Exception $ex) {

            echo "<center><code>" . $ex->getMessage() . "</code></center>";
            #de esta manera se realiza el log de eventos en la tabla mvc_event_log
            Yii::app()->eventManager->registerException('Telnet', $ex->getTraceAsString());
        }
    }

    public function exportar() {
        try {
            $modelRol = PermissionsRoles::model()->findAll(array('select' => 'rol', 'group' => 'rol'));
            $arrJson = array();
            foreach ($modelRol as $rol) {
                $modelRolTransaccion = PermissionsRoles::model()->findAll(array('select' => 'controller', 'condition' => 'rol=:rol', 'group' => 'controller',
                    'params' => array(':rol' => $rol->rol)));
                $arrTransaccion = array();
                foreach ($modelRolTransaccion as $rolTransaccion) {
                    $modelActionTransaccion = PermissionsRoles::model()->findAll(array('select' => 'action', 'condition' => 'controller=:controller', 'group' => 'action',
                        'params' => array(':controller' => $rolTransaccion->controller)));
                    $arrCrud = array();
                    foreach ($modelActionTransaccion as $crudTransaccion) {
                        $arrCrud[] = '"' . $crudTransaccion->action . '"';
                    }
                    $arrTransaccion[] = '"' . $rolTransaccion->controller . '":[' . implode(',', $arrCrud) . ']';
                }
                $arrJson[] = '"' . $rol->rol . '":{' . implode(',', $arrTransaccion) . '}';
            }
            $json = '{' . implode(',', $arrJson) . '}';
            Yii::app()->user->setFlash('success', $json);
        } catch (Exception $ex) {

            echo "<center><code>" . $ex->getMessage() . "</code></center>";
            #de esta manera se realiza el log de eventos en la tabla mvc_event_log
            Yii::app()->eventManager->registerException('ExportarJson', $ex->getTraceAsString());
        }
    }

}
