<?php
namespace MicroPHPAnswerer\Tools;

use MicroPHPAnswerer\Tools\Exceptions\ConfigNotFoundException;
use MicroPHPAnswerer\Tools\Exceptions\EnvironmentFileNotFoundException;

/**
 * Classe responsavel por Criar e Manipular as variaveis de ambiente
 */
class EnvironmentHelper
{
    const PATHNAME = 'MPA/EnvironmentConfiguration.xml';
    private static $configurations = [];

    /*
     * Funcao para inicializar as configrações de ambiente
     * @return void
     */
    private static function findConfigurationFile() :string {
        $pathName = EnvironmentHelper::PATHNAME;

        $path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$pathName;
        if (file_exists($path)) {
            return $path;
        }

        if (defined('ENVIRONMENTPATH')) {
            $path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.ENVIRONMENTPATH.$pathName;
            if (file_exists($path)) {
                return $path;
            }
        }

        if (isset($_REQUEST['forceCreation'])) {
            $path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$pathName;
            echo file_put_contents($path, "");
        } else {
            throw new EnvironmentFileNotFoundException();
        }
    }

    /*
     * Funcao para inicializar as configrações de ambiente
     * @return void
     */
    private static function initConfigurationVariables() :void {
        if ($xml = simplexml_load_file(EnvironmentHelper::findConfigurationFile())) {
            $json = json_encode($xml);
            EnvironmentHelper::$configurations = json_decode($json, true);
        }
    }

    /*
     * Funcao para pegar Parametro com a configuração que deseja
     * @param string $configuration Parametro com a configuração que deseja
     * @return string configuration
     */
    public static function getConfiguration(string $configuration) :string {
        if (empty(EnvironmentHelper::$configurations)) {
            EnvironmentHelper::initConfigurationVariables();
        }

        return EnvironmentHelper::$configurations[$configuration] ?? '';
    }
}
