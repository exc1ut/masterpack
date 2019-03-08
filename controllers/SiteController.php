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

                $dogovortable->save() or print_r($dogovortable->errors);
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
                $posbank->save() or print_r($posbank->errors);

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
                'time' => $time,
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
                $dogovor = new DogovorTable();
                $sirya->postavshik_schet_faktura_id = $schet->id;
                $sirya->format = $_POST["SkladSirya"]["format"][$i];
                $sirya->ves = $_POST["SkladSirya"]["ves"][$i];
                $sirya->date = $date;
                $sirya->is_come = 1;
                $dg = $dogovor->findOne($_POST["SkladSirya"]["postavshik_schet_faktura_id"][$i]);
                $sirya->kratkoe_naimenovanie = $dg["kratkoe_naimenovanie"];
                $sirya->time = $time;
                $sirya->save() or print_r($sirya->errors);

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
        $sklad_model = new SkladSirya();
        if($_POST)
        {

            foreach($_POST["id"] as $key=>$id)
            {
                $rashod_model = new Ostatok();
                $rm = new Rashod();
                $rashod_query = $rashod_model->findOne($id);
                $query = $sklad_model->findOne($id);
                if($rashod_query->id !== $query->id)
                {
                    $rashod_model->id = $query->id;
                    $rashod_model->postavshik_schet_faktura_id = $query->postavshik_schet_faktura_id;
                    $rashod_model->kratkoe_naimenovanie = $query->kratkoe_naimenovanie;
                    $rashod_model->format = $query->format;
                    $rashod_model->ves = $query->ves - $_POST["ves"][$key];
                    $rashod_model->date = $query->date;
                    $rashod_model->is_come = 0;
                    $rashod_model->time = $query->time;

                    $rashod_model->save() or var_dump($rm->errors);

                    $rm->id = $query->id;
                    $rm->postavshik_schet_faktura_id = $query->postavshik_schet_faktura_id;
                    $rm->kratkoe_naimenovanie = $query->kratkoe_naimenovanie;
                    $rm->format = $query->format;
                    $rm->ves = $_POST["ves"][$key];
                    $rm->date = $query->date;
                    $rm->is_come = 0;
                    $rm->time = $query->time;

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
        $sklad_model = new SkladSirya();
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
            'clients'=>$clients,
            'tip'=>$tip,
            'id'=>$id,
            'ves'=>$ves,
            'format'=>$format,
            'date'=>$date,
            'time'=>$time,
            'dogovor'=>$dogovor,
            'schet'=>$schet,
        ];


       return json_encode($arr, true);

    }
    public function actionGetsorteditems($id = 0,$client_id = 0,$dogovor_id = 0,$schet = 0,$tip_id = 0,$ves = 0,$format = 0,$date = 0,$time = 0)
    {

        $arrays = [];

        if($client_id !== 0) {

            $client_model  = new ClientRegistration();
            $clients = $client_model->findOne($client_id);
            $dogovors = $clients->dogovors;
            $items["client_name"][$clients->id] = $clients->name;
            foreach($dogovors as $dogovor)
            {
                $items["dogovors"][$dogovor->id] = $dogovor->dogovor_nomer  ;
                foreach($dogovor->tip as $tip)
                {
                    $items["schet"][$tip->id] = $tip->schet_faktura_nomer;
                    foreach($tip->sklad as $sklad)
                    {
                        $items["id"][$sklad->id] = $sklad->id;
                        $items["ves"][$sklad->id] = $sklad->ves;
                        $items["tip"][$sklad->id] = $sklad->kratkoe_naimenovanie;
                        $items["format"][$sklad->id] = $sklad->format;
                        $items["date"][$sklad->id] = $sklad->date;
                        $items["time"][$sklad->id] = $sklad->time;
                    }
                }
            }
            $arrays[] = $items;


        }
        if($dogovor_id !== 0) {
            $dogovor_model  = new Dogovor();
            $dogovors = $dogovor_model->findOne($dogovor_id);
            $tips = $dogovors->tip;

            $dogovor_client = $dogovors->client;

            $dogovor_items["client_name"][$dogovor_client->id] = $dogovor_client->name;
            $dogovor_items["dogovors"][$dogovors->id] = $dogovors->dogovor_nomer;

                foreach($tips as $tip)
                {
                    $dogovor_items["schet"][$tip->id] = $tip->schet_faktura_nomer;
                    foreach($tip->sklad as $sklad)
                    {

                        $dogovor_items["ves"][$sklad->id] = $sklad->ves;
                        $dogovor_items["id"][$sklad->id] = $sklad->id;
                        $dogovor_items["tip"][$sklad->id] = $sklad->kratkoe_naimenovanie;
                        $dogovor_items["format"][$sklad->id] = $sklad->format;
                        $dogovor_items["date"][$sklad->id] = $sklad->date;
                        $dogovor_items["time"][$sklad->id] = $sklad->time;
                    }
                }
                $arrays[] = $dogovor_items;
            }

        if($schet !== 0) {
            $schet_model  = new PostavshikSchetFaktura();
            $schets = $schet_model->findOne($schet);


            $schet_dogovor = $schets->dogovor;
            $schet_client= $schets->dogovor->client;

            $schet_items["client_name"][$schet_client->id] = $schet_client->name;
            $schet_items["dogovors"][$schet_dogovor->id] = $schet_dogovor->dogovor_nomer;

            $sklads = $schets->sklad;
            $schet_items["schet"][$schets->id] = $schets->schet_faktura_nomer;

                foreach($sklads as $sklad)
                {

                    $schet_items["ves"][$sklad->id] = $sklad->ves;
                    $schet_items["id"][$sklad->id] = $sklad->id;
                    $schet_items["tip"][$sklad->id] = $sklad->kratkoe_naimenovanie;
                    $schet_items["format"][$sklad->id] = $sklad->format;
                    $schet_items["date"][$sklad->id] = $sklad->date;
                    $schet_items["time"][$sklad->id] = $sklad->time;
                }
            $arrays[] = $schet_items;
        }

        if($tip_id !== 0) {
            $sklad_model  = new SkladSirya();
            $sklad_tips = $sklad_model->findOne($tip_id);
            $tip_schet = $sklad_tips->schetid;
            $tip_client = $tip_schet->dogovor->client->name;
            $tip_dogovor = $tip_schet->dogovor->dogovor_nomer;
            $tip_schet_nomer = $tip_schet->schet_faktura_nomer;
            $tip_items["client_name"][$tip_schet->dogovor->client->id] = $tip_client;
            $tip_items["dogovors"][$tip_schet->dogovor->id] = $tip_dogovor;
            $tip_items["id"][$sklad_tips->id] = $sklad_tips->id;
            $tip_items["schet"][$tip_schet->id] = $tip_schet_nomer;
            $tip_items["ves"][$sklad_tips->id] = $sklad_tips->ves;
            $tip_items["tip"][$sklad_tips->id] = $sklad_tips->kratkoe_naimenovanie;
            $tip_items["format"][$sklad_tips->id] = $sklad_tips->format;
            $tip_items["date"][$sklad_tips->id] = $sklad_tips->date;
            $tip_items["time"][$sklad_tips->id] = $sklad_tips->time;


            $arrays[] = $tip_items;
        }
        if($id !== 0) {
            $sklad_id_model  = new SkladSirya();
            $sklad_id_tips = $sklad_id_model->findOne($id);
            $sklad_id_tips_schet = $sklad_id_tips->schetid;
            $tip_client = $sklad_id_tips_schet->dogovor->client->name;
            $tip_dogovor = $sklad_id_tips_schet->dogovor->dogovor_nomer;
            $id_schet_nomer = $sklad_id_tips_schet->schet_faktura_nomer;
            $id_items["client_name"][$sklad_id_tips_schet->dogovor->client->id] = $tip_client;
            $id_items["dogovors"][$sklad_id_tips_schet->dogovor->id] = $tip_dogovor;
            $id_items["id"][$sklad_id_tips->id] = $sklad_id_tips->id;
            $id_items["schet"][$sklad_id_tips_schet->id] = $id_schet_nomer;
            $id_items["ves"][$sklad_id_tips->id] = $sklad_id_tips->ves;
            $id_items["tip"][$sklad_id_tips->id] = $sklad_id_tips->kratkoe_naimenovanie;
            $id_items["format"][$sklad_id_tips->id] = $sklad_id_tips->format;
            $id_items["date"][$sklad_id_tips->id] = $sklad_id_tips->date;
            $id_items["time"][$sklad_id_tips->id] = $sklad_id_tips->time;


            $arrays[] = $id_items;
        }
        if($ves !== 0) {
            $ves_model  = new SkladSirya();
            $sklad_ves = $ves_model->findOne($ves);
            $sklad_ves_schet = $sklad_ves->schetid;
            $ves_client = $sklad_ves_schet->dogovor->client->name;
            $ves_dogovor = $sklad_ves_schet->dogovor->dogovor_nomer;
            $ves_schet = $sklad_ves_schet->schet_faktura_nomer;
            $ves_items["client_name"][$sklad_ves_schet->dogovor->client->id] = $ves_client;
            $ves_items["dogovors"][$sklad_ves_schet->dogovor->id] = $ves_dogovor;
            $ves_items["id"][$sklad_ves->id] = $sklad_ves->id;
            $ves_items["schet"][$sklad_ves_schet->id] = $ves_schet;
            $ves_items["ves"][$sklad_ves->id] = $sklad_ves->ves;
            $ves_items["tip"][$sklad_ves->id] = $sklad_ves->kratkoe_naimenovanie;
            $ves_items["format"][$sklad_ves->id] = $sklad_ves->format;
            $ves_items["date"][$sklad_ves->id] = $sklad_ves->date;
            $ves_items["time"][$sklad_ves->id] = $sklad_ves->time;


            $arrays[] = $ves_items;
        }
        if($date !== 0) {
            $date_model  = new SkladSirya();
            $sklad_date = $date_model->findOne($date);
            $sklad_date_schet = $sklad_date->schetid;
            $date_client = $sklad_date_schet->dogovor->client->name;
            $date_dogovor = $sklad_date_schet->dogovor->dogovor_nomer;
            $date_schet = $sklad_date_schet->schet_faktura_nomer;
            $date_items["client_name"][$sklad_date_schet->dogovor->client->id] = $date_client;
            $date_items["dogovors"][$sklad_date_schet->dogovor->id] = $date_dogovor;
            $date_items["id"][$sklad_date->id] = $sklad_date->id;
            $date_items["schet"][$sklad_date_schet->id] = $date_schet;
            $date_items["ves"][$sklad_date->id] = $sklad_date->ves;
            $date_items["tip"][$sklad_date->id] = $sklad_date->kratkoe_naimenovanie;
            $date_items["format"][$sklad_date->id] = $sklad_date->format;
            $date_items["date"][$sklad_date->id] = $sklad_date->date;
            $date_items["time"][$sklad_date->id] = $sklad_date->time;


            $arrays[] = $date_items;
        }
        if($format !== 0) {
            $format_model  = new SkladSirya();
            $sklad_format = $format_model->findOne($format);
            $sklad_format_schet = $sklad_format->schetid;
            $format_client = $sklad_format_schet->dogovor->client->name;
            $format_dogovor = $sklad_format_schet->dogovor->dogovor_nomer;
            $format_schet = $sklad_format_schet->schet_faktura_nomer;
            $format_items["client_name"][$sklad_format_schet->dogovor->client->id] = $format_client;
            $format_items["dogovors"][$sklad_format_schet->dogovor->id] = $format_dogovor;
            $format_items["id"][$sklad_format->id] = $sklad_format->id;
            $format_items["schet"][$sklad_format_schet->id] = $format_schet;
            $format_items["ves"][$sklad_format->id] = $sklad_format->ves;
            $format_items["tip"][$sklad_format->id] = $sklad_format->kratkoe_naimenovanie;
            $format_items["format"][$sklad_format->id] = $sklad_format->format;
            $format_items["date"][$sklad_format->id] = $sklad_format->date;
            $format_items["time"][$sklad_format->id] = $sklad_format->time;
            $arrays[] = $format_items;
        }
        if($time !== 0) {
            $time_model  = new SkladSirya();
            $sklad_time = $time_model->findOne($time);
            $sklad_time_schet = $sklad_time->schetid;
            $time_client = $sklad_time_schet->dogovor->client->name;
            $time_dogovor = $sklad_time_schet->dogovor->dogovor_nomer;
            $time_schet = $sklad_time_schet->schet_faktura_nomer;
            $time_items["client_name"][$sklad_time_schet->dogovor->client->id] = $time_client;
            $time_items["dogovors"][$sklad_time_schet->dogovor->id] = $time_dogovor;
            $time_items["id"][$sklad_time->id] = $sklad_time->id;
            $time_items["schet"][$sklad_time_schet->id] = $time_schet;
            $time_items["ves"][$sklad_time->id] = $sklad_time->ves;
            $time_items["tip"][$sklad_time->id] = $sklad_time->kratkoe_naimenovanie;
            $time_items["format"][$sklad_time->id] = $sklad_time->format;
            $time_items["date"][$sklad_time->id] = $sklad_time->date;
            $time_items["time"][$sklad_time->id] = $sklad_time->time;
            $arrays[] = $time_items;
        }


        $sorted = [];
        foreach($arrays as $array)
        {
            $sorted==null&&$sorted=$array;

            if(count($sorted["client_name"])>=count($array["client_name"])) {
                $sorted["client_name"] =$array["client_name"] ;
            }
            if(count($sorted["id"])>=count($array["id"])) {
                $sorted["id"] =$array["id"] ;
            }
            if(count($sorted["dogovors"])>=count($array["dogovors"])) {
                $sorted["dogovors"] =$array["dogovors"] ;
            }
            if(count($sorted["schet"])>=count($array["schet"])) {
                $sorted["schet"] =$array["schet"] ;
            }
            if(count($sorted["ves"])>=count($array["ves"])) {
                $sorted["ves"] =$array["ves"] ;
            }
            if(count($sorted["tip"])>=count($array["tip"])) {
                $sorted["tip"] =$array["tip"] ;
            }
            if(count($sorted["format"])>=count($array["format"])) {
                $sorted["format"] =$array["format"] ;
            }
            if(count($sorted["date"])>=count($array["date"])) {
                $sorted["date"] =$array["date"] ;
            }
            if(count($sorted["time"])>=count($array["time"])) {
                $sorted["time"] =$array["time"] ;
            }

        }

        return json_encode($sorted);
        }
    public function actionOtchet()
    {
        $model_name = "rashod";
        $client_model = new ClientRegistration();
        $clients = $client_model->find()->all();
        $items = ArrayHelper::map($clients, 'id', 'name');
        return $this->render('otchetpage', [
                'model' => $client_model,
                'items' => $items,
                'model_name' => $model_name
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
        $model = new Dogovor();
        $items = [];
        $queries = $model->find()->where(['between', 'date',$start_date, $end_date])->andWhere(['postavshik'=>$values])->all();
        $itog = [];
        $itog["ves"] = 0;
        $itog["cost"] = 0;
        $items = [];
        $i = 0;
        foreach($queries as $key=>$query)
        {




            foreach($query->tip as $schet)
            {
                if($model_name == "ostatok")
                {
                    $model_n=$schet->ostatok;
                }
                elseif($model_name == "rashod")
                {
                    $model_n = $schet->rashod;
                }
                else
                {
                    $model_n = $schet->sklad;
                }
                foreach($model_n as $sklad)
                {
                    $ves = [];
                    $tip_all = [];
                    $id = [];

                    $client = $query->client->name;


                    foreach($query->dogovors as $dogovor)
                    {
                        if($dogovor->kratkoe_naimenovanie == $sklad->kratkoe_naimenovanie)
                        {
                            $cost = $dogovor->cost1;
                        }
                        $itog["cost"] += $cost;
                    }

                    $id[] = $sklad->id;
                    $ves[] = $sklad->ves;
                    $tip_all = $sklad->kratkoe_naimenovanie;
                    $itog["ves"] += array_sum($ves);
                    $items[$i]["dogovor_nomer"]=$query->dogovor_nomer;
                    $items[$i]["cost"] = $cost;
                    $items[$i]["client"] = $query->client->name;
                    $items[$i]["id"] = $sklad->id;
                    $items[$i]["ves"] = $ves;
                    $items[$i]["tip"] = $tip_all;
                    $items[$i]["cost"] = $cost;
                    $items[$i]["schet"] = $schet->schet_faktura_nomer;
                    $items[$i]["format"] = $sklad->format;
                    $items[$i]["date"] = $sklad->date;
                    $items[$i]["time"] = $sklad->time;
                    $i++;
                }
            }


        }
        $req = [$items,$itog];
        return json_encode($req);
    }
    public function actionOstatok()
    {
        $model_name = "ostatok";
        $client_model = new ClientRegistration();
        $clients = $client_model->find()->all();
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
        $postavshik = new Ostatok();
        $allpostavshik = $postavshik->find()->all();
        $kn =  ArrayHelper::map($allpostavshik, 'kratkoe_naimenovanie', 'kratkoe_naimenovanie');
        $format =  ArrayHelper::map($allpostavshik, 'format', 'format');
        return $this->render('table',[
            'model'=>$postavshik,
            'kn'=>$kn,
            'format'=>$format
        ]);
    }
    public function actionGettable($format,$tip,$date)
    {
        $model = new Ostatok();
        $queries = $model->find()->where(['format'=>$format])->andWhere(['kratkoe_naimenovanie'=>$tip])->andWhere(['date'=>$date])->all();
        foreach ($queries as $key=>$query)
        {
            $table["head"][$query->id] = $query->format;
        }
        foreach($queries as $numb => $query)
        {
            foreach ($table["head"] as $key => $format)
            {
                $table["body"][$numb][0] = $query->kratkoe_naimenovanie;
                if($query->id == $key)
                {
                    $table["body"][$numb][] = $query->ves;
                }
                else {
                    $table["body"][$numb][] = '';
                }

            }

        }


        //sum column

        for($j=0,$sum=0;$j<count($table["head"]);$j++,$sum=0)
        {

            for($i=0; $i<count($table["body"]) ; $i++)
            {
                $sum += $table["body"][$i][$j+1];
            }
            $table["sum"][] = $sum;
        }
        //sum row

            foreach($table["body"] as $key=>$value)
            {
                $table["row_sum"][] = array_sum($table["body"][$key]);
            }
                $table["sum"][] = array_sum($table["row_sum"]);
        return json_encode($table);

    }

}
