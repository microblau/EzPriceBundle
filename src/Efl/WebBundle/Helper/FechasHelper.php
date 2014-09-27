<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/09/14
 * Time: 17:14
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\Core\Helper\TranslationHelper;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;


class FechasHelper
{
    /**
     * @var \DateTime
     */
    private $firstDay;

    /**
     * @var \DateTime
     */
    private $lastDay;

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var TranslatorHelper
     */
    private $translationHelper;

    public function __construct(
        LocationService $locationService,
        SearchService $searchService,
        ContentService $contentService,
        TranslationHelper $translationHelper
    )
    {
        $this->locationService = $locationService;
        $this->searchService = $searchService;
        $this->contentService = $contentService;
        $this->translationHelper = $translationHelper;
    }

    /**
     * Setea el intervalo de fechas con el que trabajaremos
     */
    public function setMonthsToShow()
    {
        $firstDay = new \DateTime( 'now -3months' );
        $this->firstDay = array(
            'month' => $firstDay->format( 'n' ),
            'year' => $firstDay->format( 'Y')
        );

        $lastDay = new \DateTime( 'now +2months' );
        $this->lastDay = array(
            'month' => $lastDay->format( 'n' ),
            'year' => $lastDay->format( 'Y')
        );
    }

    /**
     * Devuelve un array con los calendarios y los listados de lanzamientos
     *
     * @return array
     */
    public function generateCalendars()
    {
        $calendars = array();
        $firstMonthDay = new \DateTime( $this->firstDay['year'] . '-' . $this->firstDay['month'] . '-01' );
        $lastMonthDay = new \DateTime( $this->lastDay['year'] . '-' . $this->lastDay['month'] . ' +1month -1second' );

        $day = $firstMonthDay;

        do
        {
            $calendars[] = $this->generateCalendar( $day );
            $day->modify( '+1month' );
        }
        while ( $day < $lastMonthDay );

        return $calendars;
    }

    /**
     * Genera el calendario para un mes
     *
     * @param \Datetime $day
     * @return array
     */
    private function generateCalendar( \Datetime $day )
    {
        $now = new \DateTime( 'now' );

        $class = 'prev';

        if ( $now->format( 'n') == $day->format( 'n' ) )
        {
            $class = 'actual';
        }
        elseif ( $now->format( 'n') < $day->format( 'n') )
        {
            $class = 'nexts';
        }

        $events = $this->getEditionsForMonth( $day );
        $table = $this->build_calendar(
            $day->format( 'n' ),
            $day->format( 'Y' ),
            $events['daysWithEditions']
        );

        return array(
            'id' => $day->format( 'mY' ),
            'events' => $events['contents'],
            'day' => $day->getTimestamp(),
            'table' => $table,
            'class' => $class
        );
    }

    /**
     * Listado lanzamientos en un mes
     *
     * @param \DateTime $day
     * @return array
     */
    private function getEditionsForMonth( \DateTime $day )
    {
        $testDay = clone $day;
        $startTimeStamp = $day->getTimestamp();
        $endTimeStamp = $testDay->modify( '+1month -1second' )->getTimestamp();

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\ContentTypeIdentifier(
                    array(
                        'producto',
                    )
                ),
                new Criterion\Field(
                    'fecha_aparicion',
                    Criterion\Operator::BETWEEN,
                    array( $startTimeStamp, $endTimeStamp )
                    )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Field( 'producto', 'fecha_aparicion', Query::SORT_ASC, 'esl-ES' ) );

        $results = $this->searchService->findLocations( $query )->searchHits;
        $contents = $daysWithEditions = array();

        foreach( $results as $result )
        {
            $content = $this->contentService->loadContent(
                $result->valueObject->contentId
            );

            $day = $content->getFieldValue( 'fecha_aparicion' )->date->format( 'j' );
            $contents[] = array(
                'name' => $this->translationHelper->getTranslatedContentName( $content ),
                'locationId' => $content->contentInfo->mainLocationId,
                'day' => $day
            );

            $daysWithEditions[] = $day;
        }

        return array(
            'contents' => $contents,
            'daysWithEditions' => array_unique( $daysWithEditions )
        );
    }

    function build_calendar($month,$year,$dateArray) {

        // Create array containing abbreviations of days of week.
        $daysOfWeek = array('S','M','T','W','T','F','S');

        // What is the first day of the month in question?
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

        // How many days does this month contain?
        $numberDays = date('t',$firstDayOfMonth);

        // Retrieve some information about the first day of the
        // month in question.
        $dateComponents = getdate($firstDayOfMonth);

        // What is the name of the month in question?
        $monthName = $dateComponents['month'];

        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayOfWeek = $dateComponents['wday'] == 0 ? 7 : $dateComponents['wday'] ;

        // Create the table tag opener and day headers


        $calendar = "<tr>";


        $currentDay = 1;

        // The variable $dayOfWeek is used to
        // ensure that the calendar
        // display consists of exactly 7 columns.

        if ( $dayOfWeek > 1 )
        $calendar .= '<td colspan="'. ( $dayOfWeek - 1 ) .'">&nbsp;</td>';


        $month = str_pad($month, 2, "0", STR_PAD_LEFT);

        while ($currentDay <= $numberDays) {

            // Seventh column (Saturday) reached. Start a new row.

            if ($dayOfWeek == 8 ) {

                $dayOfWeek = 1;
                $calendar .= "</tr><tr>";

            }

            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

            $date = "$year-$month-$currentDayRel";

            $class = in_array( $currentDay, $dateArray ) ? ' class="publicacion"' : '';
            $calendar .= '<td';
            if ( !empty( $class ) )
            {
                $calendar.= $class;
            }
            $calendar .= '><span>' . $currentDay . '</span></td>';

            // Increment counters

            $currentDay++;
            $dayOfWeek++;

        }



        // Complete the row of the last week in month, if necessary

        if ($dayOfWeek != 7) {

            $remainingDays = 8 - $dayOfWeek;
            if ( $remainingDays > 0 )
            $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";

        }

        $calendar .= "</tr>";

        return $calendar;

    }
}
