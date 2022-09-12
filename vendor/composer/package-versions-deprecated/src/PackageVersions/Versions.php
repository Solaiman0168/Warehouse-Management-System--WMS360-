<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'automattic/woocommerce' => '1.3.0@6181e20b96e95b2be8639d1e1dce76cc98856339',
  'aws/aws-crt-php' => 'v1.0.2@3942776a8c99209908ee0b287746263725685732',
  'aws/aws-sdk-php' => '3.215.1@32cb9c6ac53ef7eb773d645ce6eda308ff069c5e',
  'bacon/bacon-qr-code' => '2.0.0@eaac909da3ccc32b748a65b127acd8918f58d9b0',
  'barryvdh/laravel-dompdf' => 'v0.9.0@5b99e1f94157d74e450f4c97e8444fcaffa2144b',
  'clousale/amazon-sp-api-php' => '2.1.3@2e50d4d4c4d4581b1e615a41b6f2d0e6d524e478',
  'clue/stream-filter' => 'v1.6.0@d6169430c7731d8509da7aecd0af756a5747b78e',
  'composer/package-versions-deprecated' => '1.11.99.5@b4f54f74ef3453349c24a845d22392cd31e65f1d',
  'dasprid/enum' => '1.0.3@5abf82f213618696dda8e3bf6f64dd042d8542b2',
  'defuse/php-encryption' => 'v2.2.1@0f407c43b953d571421e0020ba92082ed5fb7620',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/cache' => '1.10.2@13e3381b25847283a91948d04640543941309727',
  'doctrine/dbal' => '2.12.1@adce7a954a1c2f14f85e94aed90c8489af204086',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '2.0.3@9cf661f4eb38f7c881cac67c75ea9b00bf97b210',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'dompdf/dompdf' => 'v1.0.2@8768448244967a46d6e67b891d30878e0e15d25c',
  'dragonmantank/cron-expression' => 'v2.3.1@65b2d8ee1f10915efb3b55597da3404f096acba2',
  'egulias/email-validator' => '2.1.24@ca90a3291eee1538cd48ff25163240695bd95448',
  'ezyang/htmlpurifier' => 'v4.14.0@12ab42bd6e742c70c0a52f7b82477fcd44e64b75',
  'fideloper/proxy' => '4.4.1@c073b2bd04d1c90e04dc1b787662b558dd65ade0',
  'fig/http-message-util' => '1.1.5@9d94dc0154230ac39e5bf89398b324a86f63f765',
  'firebase/php-jwt' => 'v5.2.0@feb0e820b8436873675fd3aca04f3728eb2185cb',
  'google/auth' => 'v1.14.3@c1503299c779af0cbc99b43788f75930988852cf',
  'guzzlehttp/guzzle' => '7.3.0@7008573787b430c1c1f650e3722d9bba59967628',
  'guzzlehttp/promises' => '1.4.0@60d379c243457e073cff02bc323a2a86cb355631',
  'guzzlehttp/psr7' => '1.7.0@53330f47520498c0ae1f61f7e2c90f55690c06a3',
  'http-interop/http-factory-guzzle' => '1.2.0@8f06e92b95405216b237521cc64c804dd44c4a81',
  'intervention/image' => '2.5.1@abbf18d5ab8367f96b3205ca3c89fb2fa598c69e',
  'jakub-onderka/php-console-color' => 'v0.2@d5deaecff52a0d61ccb613bb3804088da0307191',
  'jakub-onderka/php-console-highlighter' => 'v0.4@9f7a229a69d52506914b4bc61bfdb199d90c5547',
  'jean85/pretty-package-versions' => '1.6.0@1e0104b46f045868f11942aea058cd7186d6c303',
  'jlevers/selling-partner-api' => '4.3.7@375dfc3b002c7d1f86ae9a9eb0bfe7649d9a1327',
  'kreait/clock' => '1.1.0@8f1fbc252e4e81298ae7c520597c25e9a6a0f454',
  'kreait/firebase-php' => '4.0.0@dd5d0314332c8f0027054d550d403d21c0d56507',
  'kreait/firebase-tokens' => '1.14.0@dc8b7da46f45538b3f413dc04a74e24dc7d6bd48',
  'laminas/laminas-diactoros' => '2.5.0@4ff7400c1c12e404144992ef43c8b733fd9ad516',
  'laminas/laminas-zendframework-bridge' => '1.1.1@6ede70583e101030bcace4dcddd648f760ddf642',
  'larabug/larabug' => '2.5.1@578072617b84f4e0e12065573debdc03b5361333',
  'laravel/framework' => 'v6.20.7@bdc79701b567c5f8ed44d212dd4a261b8300b9c3',
  'laravel/passport' => 'v9.4.0@011bd500e8ae3d459b692467880a49ff1ecd60c0',
  'laravel/sanctum' => 'v2.12.1@e610647b04583ace6b30c8eb74cee0a866040420',
  'laravel/tinker' => 'v1.0.10@ad571aacbac1539c30d480908f9d0c9614eaf1a7',
  'lcobucci/jwt' => '3.4.2@17cb82dd625ccb17c74bf8f38563d3b260306483',
  'league/commonmark' => '1.5.7@11df9b36fd4f1d2b727a73bf14931d81373b9a54',
  'league/event' => '2.2.0@d2cc124cf9a3fab2bb4ff963307f60361ce4d119',
  'league/flysystem' => '1.1.3@9be3b16c877d477357c015cec057548cf9b2a14a',
  'league/mime-type-detection' => '1.5.1@353f66d7555d8a90781f6f5e7091932f9a4250aa',
  'league/oauth2-server' => '8.2.3@70bb329bc79b7965a56f46e293da946c5a976ef1',
  'maennchen/zipstream-php' => '2.1.0@c4c5803cc1f93df3d2448478ef79394a5981cc58',
  'markbaker/complex' => '3.0.1@ab8bc271e404909db09ff2d5ffa1e538085c0f22',
  'markbaker/matrix' => '3.0.0@c66aefcafb4f6c269510e9ac46b82619a904c576',
  'michelmelo/mm-laravel-auto-git-pull' => '1.4.0@608e86e019e0823c479008c252452665c6f426f2',
  'monolog/monolog' => '2.1.1@f9eee5cec93dfb313a38b6b288741e84e53f02d5',
  'mtdowling/jmespath.php' => '2.6.0@42dae2cbd13154083ca6d70099692fef8ca84bfb',
  'myclabs/php-enum' => '1.8.3@b942d263c641ddb5190929ff840c68f78713e937',
  'nesbot/carbon' => '2.42.0@d0463779663437392fe42ff339ebc0213bd55498',
  'nikic/php-parser' => 'v4.10.3@dbe56d23de8fcb157bbc0cfb3ad7c7de0cfb0984',
  'nyholm/psr7' => '1.3.2@a272953743c454ac4af9626634daaf5ab3ce1173',
  'opis/closure' => '3.6.1@943b5d70cc5ae7483f6aff6ff43d7e34592ca0f5',
  'paragonie/random_compat' => 'v2.0.19@446fc9faa5c2a9ddf65eb7121c0af7e857295241',
  'peal/laravel-barcode-generator' => '1.3.1@0e7b8016836142f09f8dafbb7701527003191189',
  'phenx/php-font-lib' => '0.5.2@ca6ad461f032145fff5971b5985e5af9e7fa88d8',
  'phenx/php-svg-lib' => 'v0.3.3@5fa61b65e612ce1ae15f69b3d223cb14ecc60e32',
  'php-http/client-common' => '2.5.0@d135751167d57e27c74de674d6a30cef2dc8e054',
  'php-http/discovery' => '1.14.1@de90ab2b41d7d61609f504e031339776bc8c7223',
  'php-http/httplug' => '2.3.0@f640739f80dfa1152533976e3c112477f69274eb',
  'php-http/message' => '1.13.0@7886e647a30a966a1a8d1dad1845b71ca8678361',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'php-http/promise' => '1.1.0@4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
  'phpclassic/php-shopify' => 'v1.1.20@00b6142f2b9a96ab5234e9250e9a0af221a6fa71',
  'phpoffice/phpspreadsheet' => '1.22.0@3a9e29b4f386a08a151a33578e80ef1747037a48',
  'phpoption/phpoption' => '1.7.5@994ecccd8f3283ecf5ac33254543eb0ac946d525',
  'phpseclib/phpseclib' => '2.0.29@497856a8d997f640b4a516062f84228a772a48a8',
  'pixelpeter/laravel5-woocommerce-api-client' => 'v3.0.0@ce134e353a6962afb20d63a309b74bfe803dd8a0',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.9.12@90da7f37568aee36b116a030c5f99c915267edd4',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.9.3@7e1633a6964b48589b142d60542f9ed31bd37a92',
  'sabberworm/php-css-parser' => '8.3.1@d217848e1396ef962fb1997cf3e2421acba7f796',
  'sentry/sdk' => '3.1.1@2de7de3233293f80d1e244bd950adb2121a3731c',
  'sentry/sentry' => '3.4.0@a92443883df6a55cbe7a062f76949f23dda66772',
  'sentry/sentry-laravel' => '2.11.1@183866ec5dc367efe4d5aa22906860e837aa6685',
  'simplesoftwareio/simple-qrcode' => '4.2.0@916db7948ca6772d54bb617259c768c9cdc8d537',
  'spatie/db-dumper' => '2.18.0@eddb2b7c6877817d97bbdc1c60d1a800bf5a267a',
  'spatie/laravel-backup' => '6.14.0@982d8377816eaceac0ac0a78fbf9b0f75fb009db',
  'spatie/temporary-directory' => '1.3.0@f517729b3793bca58f847c5fd383ec16f03ffec6',
  'swiftmailer/swiftmailer' => 'v6.2.4@56f0ab23f54c4ccbb0d5dcc67ff8552e0c98d59e',
  'symfony/console' => 'v4.4.17@c8e37f6928c19816437a4dd7bf16e3bd79941470',
  'symfony/css-selector' => 'v5.2.0@b8d8eb06b0942e84a69e7acebc3e9c1e6e6e7256',
  'symfony/debug' => 'v4.4.17@65fe7b49868378319b82da3035fb30801b931c47',
  'symfony/deprecation-contracts' => 'v2.2.0@5fa56b4074d1ae755beb55617ddafe6f5d78f665',
  'symfony/error-handler' => 'v4.4.17@b0887cf8fc692eef2a4cf11cee3c5f5eb93fcfdf',
  'symfony/event-dispatcher' => 'v4.4.17@f029d6f21eac61ab23198e7aca40e7638e8c8924',
  'symfony/event-dispatcher-contracts' => 'v1.1.9@84e23fdcd2517bf37aecbd16967e83f0caee25a7',
  'symfony/finder' => 'v4.4.17@9f1d1d883b79a91ef320c0c6e803494e042ef36e',
  'symfony/http-client' => 'v5.2.12@1895ede860a198803395a67738104211508b5ddc',
  'symfony/http-client-contracts' => 'v2.3.1@41db680a15018f9c1d4b23516059633ce280ca33',
  'symfony/http-foundation' => 'v4.4.17@9eeb37ec0ff3049c782ca67041648e28ddd75a94',
  'symfony/http-kernel' => 'v4.4.17@9f5605ee05406d8afa40dc4f2954c6a61de3a984',
  'symfony/mime' => 'v5.2.0@05f667e8fa029568964fd3bec6bc17765b853cc5',
  'symfony/options-resolver' => 'v5.4.3@cc1147cb11af1b43f503ac18f31aa3bec213aba8',
  'symfony/polyfill-ctype' => 'v1.20.0@f4ba089a5b6366e453971d3aad5fe8e897b37f41',
  'symfony/polyfill-iconv' => 'v1.20.0@c536646fdb4f29104dd26effc2fdcb9a5b085024',
  'symfony/polyfill-intl-idn' => 'v1.20.0@3b75acd829741c768bc8b1f84eb33265e7cc5117',
  'symfony/polyfill-intl-normalizer' => 'v1.20.0@727d1096295d807c309fb01a851577302394c897',
  'symfony/polyfill-mbstring' => 'v1.20.0@39d483bdf39be819deabf04ec872eb0b2410b531',
  'symfony/polyfill-php72' => 'v1.20.0@cede45fcdfabdd6043b3592e83678e42ec69e930',
  'symfony/polyfill-php73' => 'v1.20.0@8ff431c517be11c78c48a39a66d37431e26a6bed',
  'symfony/polyfill-php80' => 'v1.20.0@e70aa8b064c5b72d3df2abd5ab1e90464ad009de',
  'symfony/polyfill-uuid' => 'v1.25.0@7529922412d23ac44413d0f308861d50cf68d3ee',
  'symfony/process' => 'v4.4.17@ec1482f13d53911a8a32e54ba6f9a3b43a57d943',
  'symfony/psr-http-message-bridge' => 'v2.0.2@51a21cb3ba3927d4b4bf8f25cc55763351af5f2e',
  'symfony/routing' => 'v4.4.17@08712c5dd5041c03e997e13892f45884faccd868',
  'symfony/service-contracts' => 'v2.2.0@d15da7ba4957ffb8f1747218be9e1a121fd298a1',
  'symfony/translation' => 'v4.4.17@84821e6a14a637e817f25d11147388695b6f790a',
  'symfony/translation-contracts' => 'v2.3.0@e2eaa60b558f26a4b0354e1bbb25636efaaad105',
  'symfony/var-dumper' => 'v4.4.17@65c6f1e848cda840ef7278686c8e30a7cc353c93',
  'tijsverkoyen/css-to-inline-styles' => '2.2.3@b43b05cf43c1b6d849478965062b6ef73e223bb5',
  'vlucas/phpdotenv' => 'v3.6.7@2065beda6cbe75e2603686907b2e45f6f3a5ad82',
  'werneckbh/laravel-qr-code' => '0.1.3@df3875022158d0f8355f54219955e32f9a9ba080',
  'werneckbh/qr-code' => '2.1.15@ec66df0ebd5a3e1ea895bb5fba82ab9c3b9ff8f0',
  'wisembly/elephant.io' => 'v3.3.1@9d56f409fe231a906af87005f83a135565632d3f',
  'beyondcode/laravel-dump-server' => '1.3.0@fcc88fa66895f8c1ff83f6145a5eff5fa2a0739a',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'filp/whoops' => '2.9.1@307fb34a5ab697461ec4c9db865b20ff2fd40771',
  'fzaninotto/faker' => 'v1.9.1@fc10d778e4b84d5bd315dad194661e091d307c6f',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'mockery/mockery' => '1.3.3@60fa2f67f6e4d3634bb4a45ff3171fa52215800d',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'nunomaduro/collision' => 'v3.1.0@88b58b5bd9bdcc54756480fb3ce87234696544ee',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.2@069a785b2141f5bcf49f3e353548dc1cce6df556',
  'phpdocumentor/type-resolver' => '1.4.0@6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0',
  'phpspec/prophecy' => '1.12.1@8ce87516be71aae9b956f81906aaf0338e0d8a2d',
  'phpunit/php-code-coverage' => '6.1.4@807e6013b00af69b6c5d9ceb4282d0393dbb9d8d',
  'phpunit/php-file-iterator' => '2.0.3@4b49fb70f067272b659ef0174ff9ca40fdaa6357',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.3@2454ae1765516d20c4ffe103d85a58a9a3bd5662',
  'phpunit/php-token-stream' => '3.1.2@472b687829041c24b25f475e14c2f38a09edf1c2',
  'phpunit/phpunit' => '7.5.20@9467db479d1b0487c99733bb1e7944d32deded2c',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '3.0.3@1071dfcef776a57013124ff35e1fc41ccd294758',
  'sebastian/diff' => '3.0.3@14f72dd46eaf2f2293cbe79c93cc0bc43161a211',
  'sebastian/environment' => '4.2.4@d47bbbad83711771f167c72d4e3f25f7fcc1f8b0',
  'sebastian/exporter' => '3.1.3@6b853149eab67d4da22291d36f5b0631c0fd856e',
  'sebastian/global-state' => '2.0.0@e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
  'sebastian/object-enumerator' => '3.0.4@e67f6d32ebd0c749cf9d1dbd9f226c727043cdf2',
  'sebastian/object-reflector' => '1.1.2@9b8772b9cbd456ab45d4a598d2dd1a1bced6363d',
  'sebastian/recursion-context' => '3.0.1@367dcba38d6e1977be014dc4b22f47a484dac7fb',
  'sebastian/resource-operations' => '2.0.2@31d35ca87926450c44eae7e2611d45a7a65ea8b3',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.2.0@75a63c33a8577608444246075ea0af0d052e452a',
  'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389',
  'laravel/laravel' => 'dev-main@c262618cd7e961c86e2fa2642bea49d5c372b17f',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}
