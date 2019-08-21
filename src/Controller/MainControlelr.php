<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainControlelr extends AbstractController
{

    /**
     * @Route(path="/", methods={"GET"})
    **/

    public function index():Response
    {
        return $this->render('landing/index.php.twig', ['package' => $this->getPack(), 'dt' => date('Y')]);
    }

    private function getPack(){
        $packages = array(
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_games.svg',
                'PACKAGE_TITLE'     => 'Игры',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>Игры для PC</li>
                <li>Игры для консолей/приставок</li>
                <li>Мобильные игры</li>
                <li>Игровая валюта и подписки</li>
            </ul>
        ',
            ),
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_soft.svg',
                'PACKAGE_TITLE'     => 'Программное<br/>обеспечение',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>Операционные системы</li>
                <li>Офисные приложения</li>
                <li>Антивирусы</li>
                <li>Видеоредакторы</li>
                <li>Словари и переводчики</li>
            </ul>
        ',
            ),
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_media.svg',
                'PACKAGE_TITLE'     => 'Мультимедиа',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>Онлайн кинотеатры</li>
                <li>Онлайн музыка</li>
                <li>Электронные книги</li>
                <li>Аудиокниги</li>
            </ul>
        ',
            ),
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_education.svg',
                'PACKAGE_TITLE'     => 'Обучение',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>Изучение иностранных языков</li>
                <li>Обучение вождению</li> 
                <li>Спортивные курсы</li> 
                <li>Курсы университетов</li>
            </ul>
        ',
            ),
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_gift_cards.svg',
                'PACKAGE_TITLE'     => 'Подарочные<br/>карты',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>Магазины бытовой техники</li>
                <li>Доставки продуктов питания из магазинов</li>
                <li>Салоны красоты</li>
                <li>Путешествия</li>
                <li>Рестораны и кафе</li>
            </ul>
        ',
            ),
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_service.svg',
                'PACKAGE_TITLE'     => 'Сервисы',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>Персональная ИТ служба</li>
                <li>Доставка продуктов с рецептами</li>
                <li>Службы Такси</li>
                <li>Каршеринг</li> 
            </ul>
        ',
            ),
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_insurance.svg',
                'PACKAGE_TITLE'     => 'Страховки',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>Страхование экрана мобильного устройства</li>
                <li>Защита покупки</li>
                <li>Страхование для путешественников</li>
                <li>Страхование имущества и здоровья</li>
                <li>Мигрантский ДМС</li>
            </ul>
        ',
            ),
            array(
                'PACKAGE_IMAGE'     => 'landing/build/img/package_health.svg',
                'PACKAGE_TITLE'     => 'Здоровье',
                'PACKAGE_TEXT'      => '
            <ul>
                <li>
                Телемедицина:
                <ul> 
                    <li>Терапевт</li>
                    <li>Педиатр</li>
                    <li>Диетолог</li>
                    <li>Косметолог</li>
                </ul>
                </li>
            </ul>
        ',
            ),
        );
        return $packages;
    }
}