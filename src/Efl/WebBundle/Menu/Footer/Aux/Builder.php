<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 13:07
 */

namespace Efl\WebBundle\Menu\Footer\Aux;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;
use eZ\Publish\Core\Helper\TranslationHelper;

/**
 * A simple eZ Publish menu provider.
 */
class Builder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ConfigResolverInterface
     */
    private $configResolver;

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * @var TranslationHelper
     */
    private $translationHelper;

    /**
     * @var array Ids de las localizaciones que formarán el menú
     */
    private $locationIds;

    public function __construct(
        FactoryInterface $factory,
        RouterInterface $router,
        ConfigResolverInterface $configResolver,
        LocationService $locationService,
        TranslationHelper $translationHelper,
        array $locationIds
    )
    {
        $this->factory = $factory;
        $this->router = $router;
        $this->configResolver = $configResolver;
        $this->locationService = $locationService;
        $this->translationHelper = $translationHelper;
        $this->locationIds = $locationIds;
    }

    /**
     * Forma el menú principal
     *
     * @param Request $request
     * @return ItemInterface
     */
    public function createMenu( Request $request )
    {
        $menu = $this->factory->createItem( 'root' );

        $children = $this->getMenuItems();

        foreach ( $children as $child )
        {
            $menu->addChild(
                $child->id,
                array(
                    'label' => /** @Ignore*/$this->translationHelper->getTranslatedContentNameByContentInfo( $child->contentInfo ),
                    'uri' => $this->router->generate( $child )
                )
            );
        }

        $menu->setChildrenAttribute( 'class', 'linksFooter' );

        return $menu;
    }

    /**
     * Obtiene los elementos que han de formar parte del menú principal
     *
     * @return \Location[]
     */
    private function getMenuItems()
    {
        $items = array();

        foreach (  $this->locationIds as $locationId )
        {
            $items[] = $this->locationService->loadLocation( $locationId );
        }

        return $items;
    }
}
