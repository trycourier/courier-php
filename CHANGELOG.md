# Changelog

## 5.0.2 (2026-01-27)

Full Changelog: [v5.0.1...v5.0.2](https://github.com/trycourier/courier-php/compare/v5.0.1...v5.0.2)

### Chores

* **internal:** minor test script reformatting ([a7ded5b](https://github.com/trycourier/courier-php/commit/a7ded5bbc239a2e3eb7a9a9b7b49f01996c659f3))
* **internal:** update `actions/checkout` version ([e417ad9](https://github.com/trycourier/courier-php/commit/e417ad92a02078ad8469ad96f05a3e7601a3721e))
* **internal:** update phpstan comments ([08a8d38](https://github.com/trycourier/courier-php/commit/08a8d38d8219522f414df3e9610891e524ae3328))


### Documentation

* **types:** clarify version field description in AutomationTemplate ([6e8ead0](https://github.com/trycourier/courier-php/commit/6e8ead0701273373081f382108b6af879ed462ea))

## 5.0.1 (2026-01-14)

Full Changelog: [v5.0.0...v5.0.1](https://github.com/trycourier/courier-php/compare/v5.0.0...v5.0.1)

### Bug Fixes

* typos in README.md ([f1a033c](https://github.com/trycourier/courier-php/commit/f1a033c8c70d2a48f5fea41af512766957d97923))


### Chores

* fix typo in descriptions ([f46d067](https://github.com/trycourier/courier-php/commit/f46d067a4a66d5a94dde8f4c02621e917c665c32))
* **internal:** codegen related update ([7b4fa3b](https://github.com/trycourier/courier-php/commit/7b4fa3ba45681760ac59e758fa94756246e343ae))
* **internal:** codegen related update ([89591b8](https://github.com/trycourier/courier-php/commit/89591b8dd16a7b9c3f55abac64ad65fef05fb94e))
* **internal:** regenerate SDK with no functional changes ([eb51446](https://github.com/trycourier/courier-php/commit/eb51446e6b4e8368d8e27053d3605d1b089fcac4))
* **internal:** regenerate SDK with no functional changes ([bd1ea2c](https://github.com/trycourier/courier-php/commit/bd1ea2c50e9c8ddee9d51c7ed6e18e30e2dc5e27))
* **readme:** remove beta warning now that we're in ga ([c3d5ef7](https://github.com/trycourier/courier-php/commit/c3d5ef7b9481b5c2762f28cff97610277eb2880f))
* remove custom code ([5b4f359](https://github.com/trycourier/courier-php/commit/5b4f359ac6c2664b81c080dba20e8f6b54629ded))

## 5.0.0 (2026-01-12)

Full Changelog: [v4.1.0...v5.0.0](https://github.com/trycourier/courier-php/compare/v4.1.0...v5.0.0)

### ⚠ BREAKING CHANGES

* replace special flag type `omittable` with just `null`

### Features

* replace special flag type `omittable` with just `null` ([dc732bd](https://github.com/trycourier/courier-php/commit/dc732bd167c823597119f44e357f64b814b7c0b2))


### Bug Fixes

* **types:** correct variants and list types in audiences filters ([65348ef](https://github.com/trycourier/courier-php/commit/65348efeefd976112df533fbecdd4cbbbbceefcc))


### Chores

* add git attributes and composer lock file ([f4733cc](https://github.com/trycourier/courier-php/commit/f4733ccba9daedee0078bbce67c4eea2699558f1))
* **internal:** codegen related update ([c3441ed](https://github.com/trycourier/courier-php/commit/c3441edf886f03302f063c7489f0745e1927a533))
* **internal:** codegen related update ([39c23af](https://github.com/trycourier/courier-php/commit/39c23af782e97f7e539a526e6a5b9530f76927d6))
* **internal:** regenerate SDK with no functional changes ([edd567c](https://github.com/trycourier/courier-php/commit/edd567c6c169ff02b52cc706f157c2fca7456675))

## 4.1.0 (2026-01-08)

Full Changelog: [v4.0.0...v4.1.0](https://github.com/trycourier/courier-php/compare/v4.0.0...v4.1.0)

### Features

* simplify and make the phpstan types more consistent ([3956a7e](https://github.com/trycourier/courier-php/commit/3956a7ea3e6db25752e418fab92a5d24dacfdb49))


### Chores

* **api:** remove audit_events, automations, brands, bulk, inbound, translations endpoints ([5ba0410](https://github.com/trycourier/courier-php/commit/5ba04109024b938f57809bcce0f2bc33194b4e39))
* **internal:** add a basic client test ([46cc7a1](https://github.com/trycourier/courier-php/commit/46cc7a16594cdb10d9465cac0ccc61772d64498e))
* **internal:** refactor auth by moving concern from base client into client ([7aec734](https://github.com/trycourier/courier-php/commit/7aec734f4c8b9069d4a5398a9fe42f8ada095ac6))

## 4.0.0 (2025-12-29)

Full Changelog: [v3.3.0...v4.0.0](https://github.com/trycourier/courier-php/compare/v3.3.0...v4.0.0)

### ⚠ BREAKING CHANGES

* use aliases for phpstan types
* use camel casing for all class properties

### Features

* add `BaseResponse` class for accessing raw responses ([5760ba2](https://github.com/trycourier/courier-php/commit/5760ba2f47a6318d66339ff2769a8927d6473da0))
* add idempotency header support ([17408d4](https://github.com/trycourier/courier-php/commit/17408d480ec536703e68a4013b88d647719f101e))
* Add timezone field to Delay schema ([fee5c42](https://github.com/trycourier/courier-php/commit/fee5c429790d3ac871ea5f4970d7bf1644400486))
* **api:** add slack/teams/pagerduty/webhook/audience recipients, remove preferences model ([739d7d7](https://github.com/trycourier/courier-php/commit/739d7d7714d97f58cb6e9145608bb2f18b75c3e0))
* improved phpstan type annotations ([d3b2bfb](https://github.com/trycourier/courier-php/commit/d3b2bfb1f6d0f9f94645c21a6fb2fb816dba0975))
* split out services into normal & raw types ([25c65d2](https://github.com/trycourier/courier-php/commit/25c65d25a3b60c208210f1ca65f3f9c8b033a1a8))
* support unwrapping envelopes ([83eb112](https://github.com/trycourier/courier-php/commit/83eb11240d2f16af4e9d20c664b89ac83015adb4))
* Update bulk API spec: make event required, document profile.email req… ([72f10c2](https://github.com/trycourier/courier-php/commit/72f10c29244af3c4ae711c18f5224d8f723330ee))
* use aliases for phpstan types ([71a9aee](https://github.com/trycourier/courier-php/commit/71a9aee4184646dfe425733d35ddc15a2d6a7aeb))
* use camel casing for all class properties ([bac38c9](https://github.com/trycourier/courier-php/commit/bac38c9dff9a14b416775a4148e5b4acca97e036))


### Bug Fixes

* a number of serialization errors ([c71acba](https://github.com/trycourier/courier-php/commit/c71acbad72fa79821a323b9e0964234d0a91aaa5))
* address some linter warnings and errors ([b5be14d](https://github.com/trycourier/courier-php/commit/b5be14dce568b3f32c36f3c63fa6f32f7a69a41f))
* correctly serialize dates ([24b9a2c](https://github.com/trycourier/courier-php/commit/24b9a2c4228d69e0082385e8d333b0afec6f1c04))
* support arrays in query param construction ([4807291](https://github.com/trycourier/courier-php/commit/4807291b2feecae43fca95cd08073cb70e7ffdd1))
* **test:** naming collision in request parameters ([58a1fb9](https://github.com/trycourier/courier-php/commit/58a1fb932b052872e3693a16ea539b254a973986))


### Chores

* ensure constant values are marked as optional in array types ([a421af3](https://github.com/trycourier/courier-php/commit/a421af35b17f859948c4090246b304481172e944))
* **internal:** codegen related update ([b321d32](https://github.com/trycourier/courier-php/commit/b321d3293c1c2b84f0bca17e1d569fefba8d6964))
* **internal:** codegen related update ([851723b](https://github.com/trycourier/courier-php/commit/851723b7189178e09531df1d881a09ed840df3ff))
* **internal:** codegen related update ([13842ed](https://github.com/trycourier/courier-php/commit/13842edc738a41f7f49d81ac9949b37a8d631d46))
* **internal:** codegen related update ([e6f46e3](https://github.com/trycourier/courier-php/commit/e6f46e307d0801da7a39166e1b15a14fbae27537))
* **internal:** codegen related update ([1508286](https://github.com/trycourier/courier-php/commit/1508286dfb9965c1933673de4df4613e23edef6a))
* **internal:** codegen related update ([cfc2c5e](https://github.com/trycourier/courier-php/commit/cfc2c5e855668af09ac67c2b59f31599a432ce7f))
* switch from `#[Api(optional: true|false)]` to `#[Required]|#[Optional]` for annotations ([f5104a3](https://github.com/trycourier/courier-php/commit/f5104a3cfd7796b164dc4ee4b2d1dff8d148b70c))
* use `$self = clone $this;` instead of `$obj = clone $this;` ([f8143c2](https://github.com/trycourier/courier-php/commit/f8143c25aff7e1207db53b828fb479ce281a6985))

## 3.3.0 (2025-12-08)

Full Changelog: [v3.2.0...v3.3.0](https://github.com/trycourier/courier-php/compare/v3.2.0...v3.3.0)

### Features

* Fix UsersGetAllTokensResponse to return object with tokens property i… ([337c6d7](https://github.com/trycourier/courier-php/commit/337c6d74b53564a3f2b25e6425fde2a1d9b26fc5))

## 3.2.0 (2025-12-08)

Full Changelog: [v3.1.2...v3.2.0](https://github.com/trycourier/courier-php/compare/v3.1.2...v3.2.0)

### Features

* Add event_ids field to Notification schema ([63710cf](https://github.com/trycourier/courier-php/commit/63710cfac8cd466951e01be129e8cc8e35c300cf))
* allow both model class instances and arrays in setters ([8aed1a0](https://github.com/trycourier/courier-php/commit/8aed1a045166df0f7960910b3ae3aa2b40c2373a))


### Chores

* be more targeted in suppressing superfluous linter warnings ([d46bb77](https://github.com/trycourier/courier-php/commit/d46bb77502c5eb0e5759d338ce664b92ec166a47))

## 3.1.2 (2025-12-03)

Full Changelog: [v3.1.1...v3.1.2](https://github.com/trycourier/courier-php/compare/v3.1.1...v3.1.2)

### Bug Fixes

* **client:** fix duplicate Go struct resulting from name derivations schema ([0dc084e](https://github.com/trycourier/courier-php/commit/0dc084e587c35b2047d2e9bb9cfd8d496573bd91))


### Chores

* formatting ([6e77ab0](https://github.com/trycourier/courier-php/commit/6e77ab02f8f97a4ea9bd4cb2d457deea3ae52ad8))

## 3.1.1 (2025-12-02)

Full Changelog: [v3.1.0...v3.1.1](https://github.com/trycourier/courier-php/compare/v3.1.0...v3.1.1)

### Bug Fixes

* phpStan linter errors ([53e37d8](https://github.com/trycourier/courier-php/commit/53e37d8fc665a840d66afdb6be9feb2117fe76dc))


### Chores

* **client:** refactor error type constructors ([2a806da](https://github.com/trycourier/courier-php/commit/2a806dae8753f9a655b2a43830f703ec58577db5))
* typing updates ([4769949](https://github.com/trycourier/courier-php/commit/47699492ba30db928f52dc28428982f8fb6b61bd))
* use non-trivial test assertions ([fe59040](https://github.com/trycourier/courier-php/commit/fe590404b8672c79f2ae2522c1d28cdc39aa2df6))
* use single quote strings ([2787d6f](https://github.com/trycourier/courier-php/commit/2787d6f5cfdb3b83b1fbb01f0fce8311093c14f1))

## 3.1.0 (2025-11-18)

Full Changelog: [v3.0.0...v3.1.0](https://github.com/trycourier/courier-php/compare/v3.0.0...v3.1.0)

### Features

* JWT scope updates ([a8404b8](https://github.com/trycourier/courier-php/commit/a8404b8f69aea56a7ed08c6eb5b3cbb1ea3fe9ad))
* Test ([c12a38f](https://github.com/trycourier/courier-php/commit/c12a38fcdc323e9d1bd84cfd236acf34951603f3))


### Bug Fixes

* rename invalid types ([bc37024](https://github.com/trycourier/courier-php/commit/bc37024e621bcf82f65e7f0a556dede0d22961be))


### Chores

* **internal:** codegen related update ([6fc30cf](https://github.com/trycourier/courier-php/commit/6fc30cf3644dc6daff6d15e9a57ff7a034268c94))

## 3.0.0 (2025-11-12)

Full Changelog: [v2.4.0-alpha0...v3.0.0](https://github.com/trycourier/courier-php/compare/v2.4.0-alpha0...v3.0.0)

### ⚠ BREAKING CHANGES

* **client:** redesign methods
* remove confusing `toArray()` alias to `__serialize()` in favour of `toProperties()`

### Features

* Attempt kick off again ([c5d8240](https://github.com/trycourier/courier-php/commit/c5d8240282cf805c9ac271f551838d5a2600d2e0))
* Changes to spec, examples and scripts ([d4f9d75](https://github.com/trycourier/courier-php/commit/d4f9d75aedae092a48782028cfe5cd0562367b0a))
* **client:** redesign methods ([ff4799d](https://github.com/trycourier/courier-php/commit/ff4799d3586fe2702f88446ae5fe43fdf8f4834c))
* Comment adjustment to kick of build ([c210eb1](https://github.com/trycourier/courier-php/commit/c210eb1aba2ad3917b702b9dd7cd40245b723edb))
* Disabled for now ([e65ace8](https://github.com/trycourier/courier-php/commit/e65ace83ec0fff7950de047c05e0c4b498a45f93))
* More PHP and attempted node automerge ([dc6ca25](https://github.com/trycourier/courier-php/commit/dc6ca25b7019784c6df3d20e979a34f6d1a2cd5c))
* Move UUID to top ([689d90c](https://github.com/trycourier/courier-php/commit/689d90cb6722cfea4a1696e0a825bd166796bd1b))
* NPM enabled ([799abeb](https://github.com/trycourier/courier-php/commit/799abeb4ede18e3082429bef261ce329cc2c2181))
* Organization update ([61b7239](https://github.com/trycourier/courier-php/commit/61b7239e69df1fa2d2826fb58769a17d53f5e8db))
* remove confusing `toArray()` alias to `__serialize()` in favour of `toProperties()` ([8a66bb3](https://github.com/trycourier/courier-php/commit/8a66bb37377e0b432231c93c60ef917de9e9c6f7))
* Reordered spec ([440fd46](https://github.com/trycourier/courier-php/commit/440fd46250526d24a8969ad1b326106f65cd1370))
* Run update ([bdb7840](https://github.com/trycourier/courier-php/commit/bdb7840e5fbe167b702688035489b6566ab37975))
* Spec Comment Change ([d840af9](https://github.com/trycourier/courier-php/commit/d840af995b0564b944b3c1cdf9adf135ec594617))
* Token Prop Description Change ([4e2f079](https://github.com/trycourier/courier-php/commit/4e2f079e5b023c8c9463f9c4a1486852d860b821))


### Bug Fixes

* Better Python Samples + Updates to naming ([acd75d9](https://github.com/trycourier/courier-php/commit/acd75d955dfc5a3904c2fb408ade087d351c6a8b))
* Comment to kick off build ([a4c0e9d](https://github.com/trycourier/courier-php/commit/a4c0e9dd2cfc40078152c0662a4e8ba34c3d97db))
* Dep Warning ([d8cb01f](https://github.com/trycourier/courier-php/commit/d8cb01fff918181b1734ba01cca0dc56ceb637a7))
* ensure auth methods return non-nullable arrays ([872e675](https://github.com/trycourier/courier-php/commit/872e67502a552308d10dd6f6e999c74f263878d6))
* inverted retry condition ([86a56d5](https://github.com/trycourier/courier-php/commit/86a56d5a012028292d76da25e7817e56b00bc564))
* Proper PHP repo ([36896b4](https://github.com/trycourier/courier-php/commit/36896b492760aa83033fc1c741ac73c8a66c6eef))
* Updated paths for each model and go example updates ([207f0b3](https://github.com/trycourier/courier-php/commit/207f0b36cf0cc3c590a045aa491f72fcb0381fd0))


### Chores

* **client:** send metadata headers ([2510e04](https://github.com/trycourier/courier-php/commit/2510e04cd6d5dfe9d4ba85805fc28a41713de62f))
* update SDK settings ([571cba6](https://github.com/trycourier/courier-php/commit/571cba6108caa1270afbffd7efb03ba075f8e385))
* update SDK settings ([7638887](https://github.com/trycourier/courier-php/commit/76388872fd6b9cfdd1b3ef5940b2b3d021cfca30))
* update SDK settings ([c6f046a](https://github.com/trycourier/courier-php/commit/c6f046a377330cc4dfa7a4a0c2dfb0997ac0d214))
* update SDK settings ([3a0b6ef](https://github.com/trycourier/courier-php/commit/3a0b6ef6561d1ead7d0fc329e3eb513fdfb6aa79))
* use pascal case for phpstan typedefs ([80f8f5e](https://github.com/trycourier/courier-php/commit/80f8f5ee360bb57dd4298a646826d5967ab2c2ca))

## 2.4.0-alpha0 (2025-10-11)

Full Changelog: [v0.0.1...v2.4.0-alpha0](https://github.com/trycourier/courier-php/compare/v0.0.1...v2.4.0-alpha0)

### Features

* **api:** manual updates ([237d13b](https://github.com/trycourier/courier-php/commit/237d13b3ebfad302a2c6e7ffbef9341cb8877533))
* **api:** manual updates ([8bf88cf](https://github.com/trycourier/courier-php/commit/8bf88cf9bdcd2ee5626f15ca7f207c1cdcf131ab))
* **api:** manual updates ([40fb68b](https://github.com/trycourier/courier-php/commit/40fb68b14046275b87a2cf15da0aa76425781cd3))
* **api:** manual updates ([716cc33](https://github.com/trycourier/courier-php/commit/716cc33f6ebc8773a9d752cd08cec0bb47caec0c))
* **api:** manual updates ([2873aec](https://github.com/trycourier/courier-php/commit/2873aeccb67a923c3aa7edb8e61f6e7ace49043c))
* **api:** manual updates ([026f0cb](https://github.com/trycourier/courier-php/commit/026f0cbd8d9aa5ed4d86c5b8a15c03d5b2eb6f77))
* **api:** manual updates ([680b9f3](https://github.com/trycourier/courier-php/commit/680b9f3c68c6a7dd765a4d46e8873e94a1fb5762))
* **api:** manual updates ([c342aa9](https://github.com/trycourier/courier-php/commit/c342aa90275f60cd773fd0790a64aacd71996ad4))
* **api:** manual updates ([da0f744](https://github.com/trycourier/courier-php/commit/da0f74418100d03d188308bf46f5cf87fdaa08c0))
* **api:** manual updates ([74177ce](https://github.com/trycourier/courier-php/commit/74177ce1d15692a5236d2b4a168606207c8caa98))
* **api:** manual updates ([6495367](https://github.com/trycourier/courier-php/commit/6495367de6b6c571a8a42d45ba1343cd22b2b452))
* **api:** manual updates ([d7167fe](https://github.com/trycourier/courier-php/commit/d7167fea3249979104879bcdc5aa0a538f0b1382))
* **api:** manual updates ([0810125](https://github.com/trycourier/courier-php/commit/081012523509497335a14289ddd59f22fe0b02c0))
* **api:** manual updates ([f7d0370](https://github.com/trycourier/courier-php/commit/f7d0370ecdd35d5d93a2af212e7d8028c71fa8b2))
* **api:** manual updates ([8a8afa9](https://github.com/trycourier/courier-php/commit/8a8afa94e86ec90331df24ad4932b46c083ada20))
* **api:** manual updates ([8d81af9](https://github.com/trycourier/courier-php/commit/8d81af955b6c2c0de4a79722adf2fc4af5ff5004))
* **api:** manual updates ([1065e40](https://github.com/trycourier/courier-php/commit/1065e40e28fe126b3c25e9814d8697570e2e8377))
* **api:** manual updates ([65e0e1d](https://github.com/trycourier/courier-php/commit/65e0e1de1119c448fb313de0d45fd2c86e101332))
* **api:** manual updates ([b068c2c](https://github.com/trycourier/courier-php/commit/b068c2c755590086018dd1e418bf4f9cadb83919))
* **api:** manual updates ([787bbe2](https://github.com/trycourier/courier-php/commit/787bbe2e2b1283c86e08c94fc0ed47686e4a168d))
* **api:** manual updates ([cf91bb7](https://github.com/trycourier/courier-php/commit/cf91bb7d610e4d0941fb9108c369a6ba114cf06c))
* **api:** manual updates ([69b8e5e](https://github.com/trycourier/courier-php/commit/69b8e5eea7b6577fa75b4b7a42765b7ffe0eeca2))
* **api:** manual updates ([90fec6c](https://github.com/trycourier/courier-php/commit/90fec6ce4d3d9db1a6241187c2866c1ef0b0004f))
* **api:** manual updates ([b3d8022](https://github.com/trycourier/courier-php/commit/b3d8022149be42b31798f039afe50eccac57fbf6))
* **api:** manual updates ([7da7b55](https://github.com/trycourier/courier-php/commit/7da7b550ebeea3be87236df7cf3cef0f9a42c60f))
* **api:** manual updates ([35136b4](https://github.com/trycourier/courier-php/commit/35136b46892428b5a9e57300469301a2e84594e2))
* **api:** manual updates ([c0b2e9a](https://github.com/trycourier/courier-php/commit/c0b2e9addada8e39e5d59247162f109deefedc2a))
* **api:** manual updates ([12fc69c](https://github.com/trycourier/courier-php/commit/12fc69c05c457d2c2256acc6ff38d4dd0c932c0c))
* **api:** manual updates ([6122095](https://github.com/trycourier/courier-php/commit/61220955d4519bf0897bb10338746cddaf973613))
* **api:** manual updates ([82256ec](https://github.com/trycourier/courier-php/commit/82256ecc695a11dc891601b07fd20272f3d01ab8))
* **api:** manual updates ([d97cac4](https://github.com/trycourier/courier-php/commit/d97cac417308ffe27000d91c20236c7c3d552dfa))
* Examples and ref polish ([36fb6aa](https://github.com/trycourier/courier-php/commit/36fb6aaf240088ff179a44da7363ea7a5663e8e0))
* Kick of merge attempt ([790938f](https://github.com/trycourier/courier-php/commit/790938f61dfc1a744f23695545c3f2169c575b04))
* Model sync ([31b1dfd](https://github.com/trycourier/courier-php/commit/31b1dfd61b239eb7a9fd2ddc3c4383cfe3af26e8))
* Polish and Kick of Java Kit Gen ([43e657a](https://github.com/trycourier/courier-php/commit/43e657acaef85001461684996aa0276dccc37233))
* Template Id ([fb86a41](https://github.com/trycourier/courier-php/commit/fb86a41ee85cfcf4fb09dff088716e736679d32e))
* Test Github Action ([67f04d9](https://github.com/trycourier/courier-php/commit/67f04d94749bccf3211e929a1312a97f7dcd4654))


### Bug Fixes

* **ci:** release doctor workflow ([edaecd4](https://github.com/trycourier/courier-php/commit/edaecd47e0ddf50b3e13af1085b67268f65ee159))
* **client:** properly import fully qualified names ([b3f0d69](https://github.com/trycourier/courier-php/commit/b3f0d69e7a2a92ed337b1402287d59bc9956922f))


### Chores

* add license ([36084b5](https://github.com/trycourier/courier-php/commit/36084b5c3d2664a8cee7043f6d59675d41bd93f0))
* **internal:** restructure some imports ([6bfa01a](https://github.com/trycourier/courier-php/commit/6bfa01a0c6a16a9881913fb4b2d3b2ad2e3465fe))
* refactor methods ([3360cd6](https://github.com/trycourier/courier-php/commit/3360cd6949ec8957568ea76ee99be4c9e023114a))
* sync repo ([c391763](https://github.com/trycourier/courier-php/commit/c391763248d47831210ddadd9425f90601599122))
* update README ([#45](https://github.com/trycourier/courier-php/issues/45)) ([506afbb](https://github.com/trycourier/courier-php/commit/506afbb0922644798c86a7003a159fd3dae50dab))
* update SDK settings ([57448fd](https://github.com/trycourier/courier-php/commit/57448fd9d9f11881b0900009063e3023d73c4edb))
* update SDK settings ([c12d3d9](https://github.com/trycourier/courier-php/commit/c12d3d902ba9ac4e7888d3307712101140f61022))
