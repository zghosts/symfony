<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Form\Extension\Validator\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 * @author David Badura <d.a.badura@gmail.com>
 */
class UploadValidatorExtension extends AbstractTypeExtension
{
    private $translator;
    private $translationDomain;

    /**
     * @param TranslatorInterface $translator        The translator for translating error messages
     * @param null|string         $translationDomain The translation domain for translating
     */
    public function __construct(TranslatorInterface $translator, $translationDomain = null)
    {
        $this->translator = $translator;
        $this->translationDomain = $translationDomain;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $translator = $this->translator;
        $translationDomain = $this->translationDomain;

        $resolver->setNormalizer('post_max_size_message', function (Options $options, $errorMessage) use ($translator, $translationDomain) {
            return $translator->trans($errorMessage, array(), $translationDomain);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'form';
    }
}
