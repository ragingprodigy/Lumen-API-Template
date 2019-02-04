<?php
declare(strict_types=1);

/**
 * Created by: dapo <o.omonayajo@gmail.com>
 * Created on: 29/01/2019, 5:01 PM
 */
 return [
     'secret' => env('JWT_SECRET'),
     /*
     |--------------------------------------------------------------------------
     | JWT Authentication Keys
     |--------------------------------------------------------------------------
     |
     | The algorithm you are using, will determine whether your tokens are
     | signed with a random string (defined in `JWT_SECRET`) or using the
     | following public & private keys.
     |
     | Symmetric Algorithms:
     | HS256, HS384 & HS512 will use `JWT_SECRET`.
     |
     | Asymmetric Algorithms:
     | RS256, RS384 & RS512 / ES256, ES384 & ES512 will use the keys below.
     |
     */
     'keys' => [
         /*
         |--------------------------------------------------------------------------
         | Public Key
         |--------------------------------------------------------------------------
         |
         | A path or resource to your public key.
         |
         | E.g. 'file://path/to/public/key'
         |
         */
         'public' => env('JWT_PUBLIC_KEY'),
         /*
         |--------------------------------------------------------------------------
         | Private Key
         |--------------------------------------------------------------------------
         |
         | A path or resource to your private key.
         |
         | E.g. 'file://path/to/private/key'
         |
         */
         'private' => env('JWT_PRIVATE_KEY'),
         'passphrase' => env('JWT_PASSPHRASE'),
     ],

     'ttl' => env('JWT_TTL', 60),
     /*
     |--------------------------------------------------------------------------
     | Refresh time to live
     |--------------------------------------------------------------------------
     |
     | Specify the length of time (in minutes) that the token can be refreshed
     | within. I.E. The user can refresh their token within a 2 week window of
     | the original token being created until they must re-authenticate.
     | Defaults to 2 weeks.
     |
     | You can also set this to null, to yield an infinite refresh time.
     | Some may want this instead of never expiring tokens for e.g. a mobile app.
     | This is not particularly recommended, so make sure you have appropriate
     | systems in place to revoke the token if necessary.
     |
     */
     'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),
     /*
     |--------------------------------------------------------------------------
     | JWT hashing algorithm
     |--------------------------------------------------------------------------
     |
     | Specify the hashing algorithm that will be used to sign the token.
     |
     | See here: https://github.com/namshi/jose/tree/master/src/Namshi/JOSE/Signer/OpenSSL
     | for possible values.
     |
     */
     'algo' => env('JWT_ALGO', 'HS512'),
 ];
