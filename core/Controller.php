<?php
namespace core;

class Controller
{
    protected $template;
    protected $errorMessages;
    public $isPost;
    public $isGet;
    public $post;
    public $get;

    public function __construct()
    {
        $action = Core::get()->actionName;
        $module = Core::get()->moduleName;
        $path = "views/{$module}/{$action}.php";
        $this->template = new Template($path);
        $this->template->controller = $this; // Set the controller object in the template

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->isPost = true;
                break;
            case 'GET':
                $this->isGet = true;
                break;
        }
        $this->post = new Post();
        $this->get = new Get();
        $this->errorMessages = [];
    }

    public function render($view = null, $data = []): array
    {
        if (!empty($view)) {
            $module = Core::get()->moduleName;
            $pathToView = "views/{$module}/{$view}.php";
            $this->template->setTemplateFilePath($pathToView);
        }

        foreach ($data as $key => $value) {
            $this->template->setParam($key, $value);
        }

        return [
            'Content' => $this->template->getHTML()
        ];
    }

    public function redirect($path): void
    {
        header("Location: {$path}");
        die;
    }

    public function addErrorMessage($message = null)
    {
        $this->errorMessages[] = $message;
        $this->template->setParam('error_message', implode('<br/>', $this->errorMessages));
    }

    public function clearErrorMessage(): void
    {
        $this->errorMessages = [];
        $this->template->setParam('error_message', null);
    }

    public function isErrorMessagesExists(): bool
    {
        return count($this->errorMessages) > 0;
    }
}
