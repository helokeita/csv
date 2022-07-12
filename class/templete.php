<?php
class templete
{
    // プロパティ(変数)
    private $filename;
    private $twig;
    private $data = array();

    // コンストラクタ
    public function __construct(string $file) {
        // Twigライブラリの読込み
        require_once './vendor/autoload.php';

        // Twigを使用するテンプレートの読込み
        $loader = new \Twig\Loader\FilesystemLoader('./view');
        $this->twig = new \Twig\Environment($loader);

        // ファイルをセット
        $this->filename = $file;
    }

    // メソッド(関数)
    // データを設定
    public function dataset($data){
        $this->data = $data;
    }

    // 表示する(レンダリング)
    public function display(){
        echo $this->twig->render($this->filename, $this->data);
    }
}
?>