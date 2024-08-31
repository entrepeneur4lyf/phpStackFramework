.
├── PROJECT_CONTEXT
├── README.md
├── SUMMARY.md
├── composer.json
├── composer.lock
├── design
│   ├── advanced-caching-system.md
│   ├── advanced-component-templating-system.md
│   ├── ai-integration-guide.md
│   ├── cache-tag-cleanup-system.md
│   ├── caching-queue-systems-guide.md
│   ├── clustering-scalability-guide.md
│   ├── comprehensive-framework-structure.md
│   ├── content-block-component-services.md
│   ├── diff-based-templating-guide.md
│   ├── diff-based-templating-system.md
│   ├── distributed-locking-system.md
│   ├── event-persistence-system.md
│   ├── event-system-guide.md
│   ├── framework-design-philosophy.md
│   ├── framework-development-roadmap.md
│   ├── phase1-development-guide.md
│   ├── phase2-development-guide.md
│   ├── phase3-development-guide.md
│   ├── rate-limited-catchup-system.md
│   ├── realtime-event-streaming.md
│   ├── server-side-rendering-guide.md
│   ├── state-management-guide.md
│   └── websocket-auth-guide.md
├── public
│   ├── index.php
│   └── js
│       └── websocket-handler.js
├── roadmap.md
├── serve.sh
├── src
│   ├── AI
│   ├── Cache
│   ├── Cluster
│   ├── Components
│   │   ├── AboutPage.php
│   │   ├── DynamicContent.php
│   │   ├── Footer.php
│   │   ├── Header.php
│   │   ├── HomePage.php
│   │   ├── MainLayout.php
│   │   └── Sidebar.php
│   ├── Console
│   │   ├── Console.php
│   │   └── stubs
│   │       └── migration.stub
│   ├── Core
│   │   ├── Application.php
│   │   ├── Cache
│   │   │   └── CacheManager.php
│   │   ├── Container.php
│   │   ├── ServiceProvider.php
│   │   └── helpers.php
│   ├── Database
│   │   ├── Connection.php
│   │   ├── Migration
│   │   │   ├── Migration.php
│   │   │   └── MigrationManager.php
│   │   ├── Model.php
│   │   ├── QueryBuilder.php
│   │   └── Relation.php
│   ├── Events
│   ├── Http
│   │   ├── MiddlewareInterface.php
│   │   ├── MiddlewarePipeline.php
│   │   ├── Request.php
│   │   └── Response.php
│   ├── Providers
│   │   ├── DatabaseServiceProvider.php
│   │   └── TemplatingServiceProvider.php
│   ├── Queue
│   ├── Routing
│   │   ├── Route.php
│   │   └── Router.php
│   ├── State
│   ├── Templating
│   │   ├── ComponentRegistry.php
│   │   ├── ComponentService.php
│   │   ├── DiffEngine.php
│   │   ├── LayoutManager.php
│   │   └── RenderEngine.php
│   ├── WebSocket
│   │   ├── MessageComponentInterface.php
│   │   ├── SwooleServer.php
│   │   ├── UpdateDispatcher.php
│   │   └── WebSocketManager.php
│   └── config
│       ├── app.php
│       └── database.php
├── storage
│   ├── ai_models
│   ├── cache
│   ├── logs
│   └── states
├── structure.md
├── tests
│   ├── Integration
│   ├── Performance
│   └── Unit
└── vendor
    ├── autoload.php
    ├── bin
    │   ├── php-parse
    │   ├── php-parse.bat
    │   ├── phpstan
    │   ├── phpstan.bat
    │   ├── phpstan.phar
    │   ├── phpstan.phar.bat
    │   ├── phpunit
    │   ├── phpunit.bat
    │   ├── var-dump-server
    │   └── var-dump-server.bat
    ├── composer
    │   ├── ClassLoader.php
    │   ├── InstalledVersions.php
    │   ├── LICENSE
    │   ├── autoload_classmap.php
    │   ├── autoload_files.php
    │   ├── autoload_namespaces.php
    │   ├── autoload_psr4.php
    │   ├── autoload_real.php
    │   ├── autoload_static.php
    │   ├── installed.json
    │   ├── installed.php
    │   └── platform_check.php
    ├── firebase
    │   └── php-jwt
    │       ├── CHANGELOG.md
    │       ├── LICENSE
    │       ├── README.md
    │       ├── composer.json
    │       └── src
    │           ├── BeforeValidException.php
    │           ├── CachedKeySet.php
    │           ├── ExpiredException.php
    │           ├── JWK.php
    │           ├── JWT.php
    │           ├── JWTExceptionWithPayloadInterface.php
    │           ├── Key.php
    │           └── SignatureInvalidException.php
    ├── guzzlehttp
    │   ├── guzzle
    │   │   ├── CHANGELOG.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── UPGRADING.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── BodySummarizer.php
    │   │       ├── BodySummarizerInterface.php
    │   │       ├── Client.php
    │   │       ├── ClientInterface.php
    │   │       ├── ClientTrait.php
    │   │       ├── Cookie
    │   │       │   ├── CookieJar.php
    │   │       │   ├── CookieJarInterface.php
    │   │       │   ├── FileCookieJar.php
    │   │       │   ├── SessionCookieJar.php
    │   │       │   └── SetCookie.php
    │   │       ├── Exception
    │   │       │   ├── BadResponseException.php
    │   │       │   ├── ClientException.php
    │   │       │   ├── ConnectException.php
    │   │       │   ├── GuzzleException.php
    │   │       │   ├── InvalidArgumentException.php
    │   │       │   ├── RequestException.php
    │   │       │   ├── ServerException.php
    │   │       │   ├── TooManyRedirectsException.php
    │   │       │   └── TransferException.php
    │   │       ├── Handler
    │   │       │   ├── CurlFactory.php
    │   │       │   ├── CurlFactoryInterface.php
    │   │       │   ├── CurlHandler.php
    │   │       │   ├── CurlMultiHandler.php
    │   │       │   ├── EasyHandle.php
    │   │       │   ├── HeaderProcessor.php
    │   │       │   ├── MockHandler.php
    │   │       │   ├── Proxy.php
    │   │       │   └── StreamHandler.php
    │   │       ├── HandlerStack.php
    │   │       ├── MessageFormatter.php
    │   │       ├── MessageFormatterInterface.php
    │   │       ├── Middleware.php
    │   │       ├── Pool.php
    │   │       ├── PrepareBodyMiddleware.php
    │   │       ├── RedirectMiddleware.php
    │   │       ├── RequestOptions.php
    │   │       ├── RetryMiddleware.php
    │   │       ├── TransferStats.php
    │   │       ├── Utils.php
    │   │       ├── functions.php
    │   │       └── functions_include.php
    │   ├── promises
    │   │   ├── CHANGELOG.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── AggregateException.php
    │   │       ├── CancellationException.php
    │   │       ├── Coroutine.php
    │   │       ├── Create.php
    │   │       ├── Each.php
    │   │       ├── EachPromise.php
    │   │       ├── FulfilledPromise.php
    │   │       ├── Is.php
    │   │       ├── Promise.php
    │   │       ├── PromiseInterface.php
    │   │       ├── PromisorInterface.php
    │   │       ├── RejectedPromise.php
    │   │       ├── RejectionException.php
    │   │       ├── TaskQueue.php
    │   │       ├── TaskQueueInterface.php
    │   │       └── Utils.php
    │   └── psr7
    │       ├── CHANGELOG.md
    │       ├── LICENSE
    │       ├── README.md
    │       ├── composer.json
    │       └── src
    │           ├── AppendStream.php
    │           ├── BufferStream.php
    │           ├── CachingStream.php
    │           ├── DroppingStream.php
    │           ├── Exception
    │           │   └── MalformedUriException.php
    │           ├── FnStream.php
    │           ├── Header.php
    │           ├── HttpFactory.php
    │           ├── InflateStream.php
    │           ├── LazyOpenStream.php
    │           ├── LimitStream.php
    │           ├── Message.php
    │           ├── MessageTrait.php
    │           ├── MimeType.php
    │           ├── MultipartStream.php
    │           ├── NoSeekStream.php
    │           ├── PumpStream.php
    │           ├── Query.php
    │           ├── Request.php
    │           ├── Response.php
    │           ├── Rfc7230.php
    │           ├── ServerRequest.php
    │           ├── Stream.php
    │           ├── StreamDecoratorTrait.php
    │           ├── StreamWrapper.php
    │           ├── UploadedFile.php
    │           ├── Uri.php
    │           ├── UriComparator.php
    │           ├── UriNormalizer.php
    │           ├── UriResolver.php
    │           └── Utils.php
    ├── hamcrest
    │   └── hamcrest-php
    │       ├── CHANGES.txt
    │       ├── LICENSE.txt
    │       ├── README.md
    │       ├── composer.json
    │       ├── generator
    │       │   ├── FactoryCall.php
    │       │   ├── FactoryClass.php
    │       │   ├── FactoryFile.php
    │       │   ├── FactoryGenerator.php
    │       │   ├── FactoryMethod.php
    │       │   ├── FactoryParameter.php
    │       │   ├── GlobalFunctionFile.php
    │       │   ├── StaticMethodFile.php
    │       │   ├── parts
    │       │   │   ├── file_header.txt
    │       │   │   ├── functions_footer.txt
    │       │   │   ├── functions_header.txt
    │       │   │   ├── functions_imports.txt
    │       │   │   ├── matchers_footer.txt
    │       │   │   ├── matchers_header.txt
    │       │   │   └── matchers_imports.txt
    │       │   └── run.php
    │       ├── hamcrest
    │       │   ├── Hamcrest
    │       │   │   ├── Arrays
    │       │   │   │   ├── IsArray.php
    │       │   │   │   ├── IsArrayContaining.php
    │       │   │   │   ├── IsArrayContainingInAnyOrder.php
    │       │   │   │   ├── IsArrayContainingInOrder.php
    │       │   │   │   ├── IsArrayContainingKey.php
    │       │   │   │   ├── IsArrayContainingKeyValuePair.php
    │       │   │   │   ├── IsArrayWithSize.php
    │       │   │   │   ├── MatchingOnce.php
    │       │   │   │   └── SeriesMatchingOnce.php
    │       │   │   ├── AssertionError.php
    │       │   │   ├── BaseDescription.php
    │       │   │   ├── BaseMatcher.php
    │       │   │   ├── Collection
    │       │   │   │   ├── IsEmptyTraversable.php
    │       │   │   │   └── IsTraversableWithSize.php
    │       │   │   ├── Core
    │       │   │   │   ├── AllOf.php
    │       │   │   │   ├── AnyOf.php
    │       │   │   │   ├── CombinableMatcher.php
    │       │   │   │   ├── DescribedAs.php
    │       │   │   │   ├── Every.php
    │       │   │   │   ├── HasToString.php
    │       │   │   │   ├── Is.php
    │       │   │   │   ├── IsAnything.php
    │       │   │   │   ├── IsCollectionContaining.php
    │       │   │   │   ├── IsEqual.php
    │       │   │   │   ├── IsIdentical.php
    │       │   │   │   ├── IsInstanceOf.php
    │       │   │   │   ├── IsNot.php
    │       │   │   │   ├── IsNull.php
    │       │   │   │   ├── IsSame.php
    │       │   │   │   ├── IsTypeOf.php
    │       │   │   │   ├── Set.php
    │       │   │   │   └── ShortcutCombination.php
    │       │   │   ├── Description.php
    │       │   │   ├── DiagnosingMatcher.php
    │       │   │   ├── FeatureMatcher.php
    │       │   │   ├── Internal
    │       │   │   │   └── SelfDescribingValue.php
    │       │   │   ├── Matcher.php
    │       │   │   ├── MatcherAssert.php
    │       │   │   ├── Matchers.php
    │       │   │   ├── NullDescription.php
    │       │   │   ├── Number
    │       │   │   │   ├── IsCloseTo.php
    │       │   │   │   └── OrderingComparison.php
    │       │   │   ├── SelfDescribing.php
    │       │   │   ├── StringDescription.php
    │       │   │   ├── Text
    │       │   │   │   ├── IsEmptyString.php
    │       │   │   │   ├── IsEqualIgnoringCase.php
    │       │   │   │   ├── IsEqualIgnoringWhiteSpace.php
    │       │   │   │   ├── MatchesPattern.php
    │       │   │   │   ├── StringContains.php
    │       │   │   │   ├── StringContainsIgnoringCase.php
    │       │   │   │   ├── StringContainsInOrder.php
    │       │   │   │   ├── StringEndsWith.php
    │       │   │   │   ├── StringStartsWith.php
    │       │   │   │   └── SubstringMatcher.php
    │       │   │   ├── Type
    │       │   │   │   ├── IsArray.php
    │       │   │   │   ├── IsBoolean.php
    │       │   │   │   ├── IsCallable.php
    │       │   │   │   ├── IsDouble.php
    │       │   │   │   ├── IsInteger.php
    │       │   │   │   ├── IsNumeric.php
    │       │   │   │   ├── IsObject.php
    │       │   │   │   ├── IsResource.php
    │       │   │   │   ├── IsScalar.php
    │       │   │   │   └── IsString.php
    │       │   │   ├── TypeSafeDiagnosingMatcher.php
    │       │   │   ├── TypeSafeMatcher.php
    │       │   │   ├── Util.php
    │       │   │   └── Xml
    │       │   │       └── HasXPath.php
    │       │   └── Hamcrest.php
    │       └── tests
    │           ├── Hamcrest
    │           │   ├── AbstractMatcherTest.php
    │           │   ├── Array
    │           │   │   ├── IsArrayContainingInAnyOrderTest.php
    │           │   │   ├── IsArrayContainingInOrderTest.php
    │           │   │   ├── IsArrayContainingKeyTest.php
    │           │   │   ├── IsArrayContainingKeyValuePairTest.php
    │           │   │   ├── IsArrayContainingTest.php
    │           │   │   ├── IsArrayTest.php
    │           │   │   └── IsArrayWithSizeTest.php
    │           │   ├── BaseMatcherTest.php
    │           │   ├── Collection
    │           │   │   ├── IsEmptyTraversableTest.php
    │           │   │   └── IsTraversableWithSizeTest.php
    │           │   ├── Core
    │           │   │   ├── AllOfTest.php
    │           │   │   ├── AnyOfTest.php
    │           │   │   ├── CombinableMatcherTest.php
    │           │   │   ├── DescribedAsTest.php
    │           │   │   ├── EveryTest.php
    │           │   │   ├── HasToStringTest.php
    │           │   │   ├── IsAnythingTest.php
    │           │   │   ├── IsCollectionContainingTest.php
    │           │   │   ├── IsEqualTest.php
    │           │   │   ├── IsIdenticalTest.php
    │           │   │   ├── IsInstanceOfTest.php
    │           │   │   ├── IsNotTest.php
    │           │   │   ├── IsNullTest.php
    │           │   │   ├── IsSameTest.php
    │           │   │   ├── IsTest.php
    │           │   │   ├── IsTypeOfTest.php
    │           │   │   ├── SampleBaseClass.php
    │           │   │   ├── SampleSubClass.php
    │           │   │   └── SetTest.php
    │           │   ├── FeatureMatcherTest.php
    │           │   ├── InvokedMatcherTest.php
    │           │   ├── MatcherAssertTest.php
    │           │   ├── Number
    │           │   │   ├── IsCloseToTest.php
    │           │   │   └── OrderingComparisonTest.php
    │           │   ├── StringDescriptionTest.php
    │           │   ├── Text
    │           │   │   ├── IsEmptyStringTest.php
    │           │   │   ├── IsEqualIgnoringCaseTest.php
    │           │   │   ├── IsEqualIgnoringWhiteSpaceTest.php
    │           │   │   ├── MatchesPatternTest.php
    │           │   │   ├── StringContainsIgnoringCaseTest.php
    │           │   │   ├── StringContainsInOrderTest.php
    │           │   │   ├── StringContainsTest.php
    │           │   │   ├── StringEndsWithTest.php
    │           │   │   └── StringStartsWithTest.php
    │           │   ├── Type
    │           │   │   ├── IsArrayTest.php
    │           │   │   ├── IsBooleanTest.php
    │           │   │   ├── IsCallableTest.php
    │           │   │   ├── IsDoubleTest.php
    │           │   │   ├── IsIntegerTest.php
    │           │   │   ├── IsNumericTest.php
    │           │   │   ├── IsObjectTest.php
    │           │   │   ├── IsResourceTest.php
    │           │   │   ├── IsScalarTest.php
    │           │   │   └── IsStringTest.php
    │           │   ├── UtilTest.php
    │           │   └── Xml
    │           │       └── HasXPathTest.php
    │           ├── bootstrap.php
    │           └── phpunit.xml.dist
    ├── mockery
    │   └── mockery
    │       ├── CHANGELOG.md
    │       ├── CONTRIBUTING.md
    │       ├── COPYRIGHT.md
    │       ├── LICENSE
    │       ├── README.md
    │       ├── SECURITY.md
    │       ├── composer.json
    │       ├── composer.lock
    │       ├── docs
    │       │   ├── Makefile
    │       │   ├── README.md
    │       │   ├── _static
    │       │   ├── conf.py
    │       │   ├── cookbook
    │       │   │   ├── big_parent_class.rst
    │       │   │   ├── class_constants.rst
    │       │   │   ├── default_expectations.rst
    │       │   │   ├── detecting_mock_objects.rst
    │       │   │   ├── index.rst
    │       │   │   ├── map.rst.inc
    │       │   │   ├── mockery_on.rst
    │       │   │   ├── mocking_class_within_class.rst
    │       │   │   ├── mocking_hard_dependencies.rst
    │       │   │   └── not_calling_the_constructor.rst
    │       │   ├── getting_started
    │       │   │   ├── index.rst
    │       │   │   ├── installation.rst
    │       │   │   ├── map.rst.inc
    │       │   │   ├── quick_reference.rst
    │       │   │   ├── simple_example.rst
    │       │   │   └── upgrading.rst
    │       │   ├── index.rst
    │       │   ├── mockery
    │       │   │   ├── configuration.rst
    │       │   │   ├── exceptions.rst
    │       │   │   ├── gotchas.rst
    │       │   │   ├── index.rst
    │       │   │   ├── map.rst.inc
    │       │   │   └── reserved_method_names.rst
    │       │   ├── reference
    │       │   │   ├── alternative_should_receive_syntax.rst
    │       │   │   ├── argument_validation.rst
    │       │   │   ├── creating_test_doubles.rst
    │       │   │   ├── demeter_chains.rst
    │       │   │   ├── expectations.rst
    │       │   │   ├── final_methods_classes.rst
    │       │   │   ├── index.rst
    │       │   │   ├── instance_mocking.rst
    │       │   │   ├── magic_methods.rst
    │       │   │   ├── map.rst.inc
    │       │   │   ├── partial_mocks.rst
    │       │   │   ├── pass_by_reference_behaviours.rst
    │       │   │   ├── phpunit_integration.rst
    │       │   │   ├── protected_methods.rst
    │       │   │   ├── public_properties.rst
    │       │   │   ├── public_static_properties.rst
    │       │   │   └── spies.rst
    │       │   └── requirements.txt
    │       └── library
    │           ├── Mockery
    │           │   ├── Adapter
    │           │   │   └── Phpunit
    │           │   │       ├── MockeryPHPUnitIntegration.php
    │           │   │       ├── MockeryPHPUnitIntegrationAssertPostConditions.php
    │           │   │       ├── MockeryTestCase.php
    │           │   │       ├── MockeryTestCaseSetUp.php
    │           │   │       ├── TestListener.php
    │           │   │       └── TestListenerTrait.php
    │           │   ├── ClosureWrapper.php
    │           │   ├── CompositeExpectation.php
    │           │   ├── Configuration.php
    │           │   ├── Container.php
    │           │   ├── CountValidator
    │           │   │   ├── AtLeast.php
    │           │   │   ├── AtMost.php
    │           │   │   ├── CountValidatorAbstract.php
    │           │   │   ├── CountValidatorInterface.php
    │           │   │   ├── Exact.php
    │           │   │   └── Exception.php
    │           │   ├── Exception
    │           │   │   ├── BadMethodCallException.php
    │           │   │   ├── InvalidArgumentException.php
    │           │   │   ├── InvalidCountException.php
    │           │   │   ├── InvalidOrderException.php
    │           │   │   ├── MockeryExceptionInterface.php
    │           │   │   ├── NoMatchingExpectationException.php
    │           │   │   └── RuntimeException.php
    │           │   ├── Exception.php
    │           │   ├── Expectation.php
    │           │   ├── ExpectationDirector.php
    │           │   ├── ExpectationInterface.php
    │           │   ├── ExpectsHigherOrderMessage.php
    │           │   ├── Generator
    │           │   │   ├── CachingGenerator.php
    │           │   │   ├── DefinedTargetClass.php
    │           │   │   ├── Generator.php
    │           │   │   ├── Method.php
    │           │   │   ├── MockConfiguration.php
    │           │   │   ├── MockConfigurationBuilder.php
    │           │   │   ├── MockDefinition.php
    │           │   │   ├── MockNameBuilder.php
    │           │   │   ├── Parameter.php
    │           │   │   ├── StringManipulation
    │           │   │   │   └── Pass
    │           │   │   │       ├── AvoidMethodClashPass.php
    │           │   │   │       ├── CallTypeHintPass.php
    │           │   │   │       ├── ClassAttributesPass.php
    │           │   │   │       ├── ClassNamePass.php
    │           │   │   │       ├── ClassPass.php
    │           │   │   │       ├── ConstantsPass.php
    │           │   │   │       ├── InstanceMockPass.php
    │           │   │   │       ├── InterfacePass.php
    │           │   │   │       ├── MagicMethodTypeHintsPass.php
    │           │   │   │       ├── MethodDefinitionPass.php
    │           │   │   │       ├── Pass.php
    │           │   │   │       ├── RemoveBuiltinMethodsThatAreFinalPass.php
    │           │   │   │       ├── RemoveDestructorPass.php
    │           │   │   │       ├── RemoveUnserializeForInternalSerializableClassesPass.php
    │           │   │   │       └── TraitPass.php
    │           │   │   ├── StringManipulationGenerator.php
    │           │   │   ├── TargetClassInterface.php
    │           │   │   └── UndefinedTargetClass.php
    │           │   ├── HigherOrderMessage.php
    │           │   ├── Instantiator.php
    │           │   ├── LegacyMockInterface.php
    │           │   ├── Loader
    │           │   │   ├── EvalLoader.php
    │           │   │   ├── Loader.php
    │           │   │   └── RequireLoader.php
    │           │   ├── Matcher
    │           │   │   ├── AndAnyOtherArgs.php
    │           │   │   ├── Any.php
    │           │   │   ├── AnyArgs.php
    │           │   │   ├── AnyOf.php
    │           │   │   ├── ArgumentListMatcher.php
    │           │   │   ├── Closure.php
    │           │   │   ├── Contains.php
    │           │   │   ├── Ducktype.php
    │           │   │   ├── HasKey.php
    │           │   │   ├── HasValue.php
    │           │   │   ├── IsEqual.php
    │           │   │   ├── IsSame.php
    │           │   │   ├── MatcherAbstract.php
    │           │   │   ├── MatcherInterface.php
    │           │   │   ├── MultiArgumentClosure.php
    │           │   │   ├── MustBe.php
    │           │   │   ├── NoArgs.php
    │           │   │   ├── Not.php
    │           │   │   ├── NotAnyOf.php
    │           │   │   ├── Pattern.php
    │           │   │   ├── Subset.php
    │           │   │   └── Type.php
    │           │   ├── MethodCall.php
    │           │   ├── Mock.php
    │           │   ├── MockInterface.php
    │           │   ├── QuickDefinitionsConfiguration.php
    │           │   ├── ReceivedMethodCalls.php
    │           │   ├── Reflector.php
    │           │   ├── Undefined.php
    │           │   ├── VerificationDirector.php
    │           │   └── VerificationExpectation.php
    │           ├── Mockery.php
    │           └── helpers.php
    ├── monolog
    │   └── monolog
    │       ├── CHANGELOG.md
    │       ├── LICENSE
    │       ├── README.md
    │       ├── composer.json
    │       └── src
    │           └── Monolog
    │               ├── Attribute
    │               │   ├── AsMonologProcessor.php
    │               │   └── WithMonologChannel.php
    │               ├── DateTimeImmutable.php
    │               ├── ErrorHandler.php
    │               ├── Formatter
    │               │   ├── ChromePHPFormatter.php
    │               │   ├── ElasticaFormatter.php
    │               │   ├── ElasticsearchFormatter.php
    │               │   ├── FlowdockFormatter.php
    │               │   ├── FluentdFormatter.php
    │               │   ├── FormatterInterface.php
    │               │   ├── GelfMessageFormatter.php
    │               │   ├── GoogleCloudLoggingFormatter.php
    │               │   ├── HtmlFormatter.php
    │               │   ├── JsonFormatter.php
    │               │   ├── LineFormatter.php
    │               │   ├── LogglyFormatter.php
    │               │   ├── LogmaticFormatter.php
    │               │   ├── LogstashFormatter.php
    │               │   ├── MongoDBFormatter.php
    │               │   ├── NormalizerFormatter.php
    │               │   ├── ScalarFormatter.php
    │               │   ├── SyslogFormatter.php
    │               │   └── WildfireFormatter.php
    │               ├── Handler
    │               │   ├── AbstractHandler.php
    │               │   ├── AbstractProcessingHandler.php
    │               │   ├── AbstractSyslogHandler.php
    │               │   ├── AmqpHandler.php
    │               │   ├── BrowserConsoleHandler.php
    │               │   ├── BufferHandler.php
    │               │   ├── ChromePHPHandler.php
    │               │   ├── CouchDBHandler.php
    │               │   ├── CubeHandler.php
    │               │   ├── Curl
    │               │   │   └── Util.php
    │               │   ├── DeduplicationHandler.php
    │               │   ├── DoctrineCouchDBHandler.php
    │               │   ├── DynamoDbHandler.php
    │               │   ├── ElasticaHandler.php
    │               │   ├── ElasticsearchHandler.php
    │               │   ├── ErrorLogHandler.php
    │               │   ├── FallbackGroupHandler.php
    │               │   ├── FilterHandler.php
    │               │   ├── FingersCrossed
    │               │   │   ├── ActivationStrategyInterface.php
    │               │   │   ├── ChannelLevelActivationStrategy.php
    │               │   │   └── ErrorLevelActivationStrategy.php
    │               │   ├── FingersCrossedHandler.php
    │               │   ├── FirePHPHandler.php
    │               │   ├── FleepHookHandler.php
    │               │   ├── FlowdockHandler.php
    │               │   ├── FormattableHandlerInterface.php
    │               │   ├── FormattableHandlerTrait.php
    │               │   ├── GelfHandler.php
    │               │   ├── GroupHandler.php
    │               │   ├── Handler.php
    │               │   ├── HandlerInterface.php
    │               │   ├── HandlerWrapper.php
    │               │   ├── IFTTTHandler.php
    │               │   ├── InsightOpsHandler.php
    │               │   ├── LogEntriesHandler.php
    │               │   ├── LogglyHandler.php
    │               │   ├── LogmaticHandler.php
    │               │   ├── MailHandler.php
    │               │   ├── MandrillHandler.php
    │               │   ├── MissingExtensionException.php
    │               │   ├── MongoDBHandler.php
    │               │   ├── NativeMailerHandler.php
    │               │   ├── NewRelicHandler.php
    │               │   ├── NoopHandler.php
    │               │   ├── NullHandler.php
    │               │   ├── OverflowHandler.php
    │               │   ├── PHPConsoleHandler.php
    │               │   ├── ProcessHandler.php
    │               │   ├── ProcessableHandlerInterface.php
    │               │   ├── ProcessableHandlerTrait.php
    │               │   ├── PsrHandler.php
    │               │   ├── PushoverHandler.php
    │               │   ├── RedisHandler.php
    │               │   ├── RedisPubSubHandler.php
    │               │   ├── RollbarHandler.php
    │               │   ├── RotatingFileHandler.php
    │               │   ├── SamplingHandler.php
    │               │   ├── SendGridHandler.php
    │               │   ├── Slack
    │               │   │   └── SlackRecord.php
    │               │   ├── SlackHandler.php
    │               │   ├── SlackWebhookHandler.php
    │               │   ├── SocketHandler.php
    │               │   ├── SqsHandler.php
    │               │   ├── StreamHandler.php
    │               │   ├── SymfonyMailerHandler.php
    │               │   ├── SyslogHandler.php
    │               │   ├── SyslogUdp
    │               │   │   └── UdpSocket.php
    │               │   ├── SyslogUdpHandler.php
    │               │   ├── TelegramBotHandler.php
    │               │   ├── TestHandler.php
    │               │   ├── WebRequestRecognizerTrait.php
    │               │   ├── WhatFailureGroupHandler.php
    │               │   └── ZendMonitorHandler.php
    │               ├── Level.php
    │               ├── LogRecord.php
    │               ├── Logger.php
    │               ├── Processor
    │               │   ├── ClosureContextProcessor.php
    │               │   ├── GitProcessor.php
    │               │   ├── HostnameProcessor.php
    │               │   ├── IntrospectionProcessor.php
    │               │   ├── LoadAverageProcessor.php
    │               │   ├── MemoryPeakUsageProcessor.php
    │               │   ├── MemoryProcessor.php
    │               │   ├── MemoryUsageProcessor.php
    │               │   ├── MercurialProcessor.php
    │               │   ├── ProcessIdProcessor.php
    │               │   ├── ProcessorInterface.php
    │               │   ├── PsrLogMessageProcessor.php
    │               │   ├── TagProcessor.php
    │               │   ├── UidProcessor.php
    │               │   └── WebProcessor.php
    │               ├── Registry.php
    │               ├── ResettableInterface.php
    │               ├── SignalHandler.php
    │               ├── Test
    │               │   └── TestCase.php
    │               └── Utils.php
    ├── myclabs
    │   └── deep-copy
    │       ├── LICENSE
    │       ├── README.md
    │       ├── composer.json
    │       └── src
    │           └── DeepCopy
    │               ├── DeepCopy.php
    │               ├── Exception
    │               │   ├── CloneException.php
    │               │   └── PropertyException.php
    │               ├── Filter
    │               │   ├── ChainableFilter.php
    │               │   ├── Doctrine
    │               │   │   ├── DoctrineCollectionFilter.php
    │               │   │   ├── DoctrineEmptyCollectionFilter.php
    │               │   │   └── DoctrineProxyFilter.php
    │               │   ├── Filter.php
    │               │   ├── KeepFilter.php
    │               │   ├── ReplaceFilter.php
    │               │   └── SetNullFilter.php
    │               ├── Matcher
    │               │   ├── Doctrine
    │               │   │   └── DoctrineProxyMatcher.php
    │               │   ├── Matcher.php
    │               │   ├── PropertyMatcher.php
    │               │   ├── PropertyNameMatcher.php
    │               │   └── PropertyTypeMatcher.php
    │               ├── Reflection
    │               │   └── ReflectionHelper.php
    │               ├── TypeFilter
    │               │   ├── Date
    │               │   │   └── DateIntervalFilter.php
    │               │   ├── ReplaceFilter.php
    │               │   ├── ShallowCopyFilter.php
    │               │   ├── Spl
    │               │   │   ├── ArrayObjectFilter.php
    │               │   │   ├── SplDoublyLinkedList.php
    │               │   │   └── SplDoublyLinkedListFilter.php
    │               │   └── TypeFilter.php
    │               ├── TypeMatcher
    │               │   └── TypeMatcher.php
    │               └── deep_copy.php
    ├── nikic
    │   └── php-parser
    │       ├── LICENSE
    │       ├── README.md
    │       ├── bin
    │       │   └── php-parse
    │       ├── composer.json
    │       └── lib
    │           └── PhpParser
    │               ├── Builder
    │               │   ├── ClassConst.php
    │               │   ├── Class_.php
    │               │   ├── Declaration.php
    │               │   ├── EnumCase.php
    │               │   ├── Enum_.php
    │               │   ├── FunctionLike.php
    │               │   ├── Function_.php
    │               │   ├── Interface_.php
    │               │   ├── Method.php
    │               │   ├── Namespace_.php
    │               │   ├── Param.php
    │               │   ├── Property.php
    │               │   ├── TraitUse.php
    │               │   ├── TraitUseAdaptation.php
    │               │   ├── Trait_.php
    │               │   └── Use_.php
    │               ├── Builder.php
    │               ├── BuilderFactory.php
    │               ├── BuilderHelpers.php
    │               ├── Comment
    │               │   └── Doc.php
    │               ├── Comment.php
    │               ├── ConstExprEvaluationException.php
    │               ├── ConstExprEvaluator.php
    │               ├── Error.php
    │               ├── ErrorHandler
    │               │   ├── Collecting.php
    │               │   └── Throwing.php
    │               ├── ErrorHandler.php
    │               ├── Internal
    │               │   ├── DiffElem.php
    │               │   ├── Differ.php
    │               │   ├── PrintableNewAnonClassNode.php
    │               │   ├── TokenPolyfill.php
    │               │   └── TokenStream.php
    │               ├── JsonDecoder.php
    │               ├── Lexer
    │               │   ├── Emulative.php
    │               │   └── TokenEmulator
    │               │       ├── AttributeEmulator.php
    │               │       ├── EnumTokenEmulator.php
    │               │       ├── ExplicitOctalEmulator.php
    │               │       ├── KeywordEmulator.php
    │               │       ├── MatchTokenEmulator.php
    │               │       ├── NullsafeTokenEmulator.php
    │               │       ├── ReadonlyFunctionTokenEmulator.php
    │               │       ├── ReadonlyTokenEmulator.php
    │               │       ├── ReverseEmulator.php
    │               │       └── TokenEmulator.php
    │               ├── Lexer.php
    │               ├── Modifiers.php
    │               ├── NameContext.php
    │               ├── Node
    │               │   ├── Arg.php
    │               │   ├── ArrayItem.php
    │               │   ├── Attribute.php
    │               │   ├── AttributeGroup.php
    │               │   ├── ClosureUse.php
    │               │   ├── ComplexType.php
    │               │   ├── Const_.php
    │               │   ├── DeclareItem.php
    │               │   ├── Expr
    │               │   │   ├── ArrayDimFetch.php
    │               │   │   ├── ArrayItem.php
    │               │   │   ├── Array_.php
    │               │   │   ├── ArrowFunction.php
    │               │   │   ├── Assign.php
    │               │   │   ├── AssignOp
    │               │   │   │   ├── BitwiseAnd.php
    │               │   │   │   ├── BitwiseOr.php
    │               │   │   │   ├── BitwiseXor.php
    │               │   │   │   ├── Coalesce.php
    │               │   │   │   ├── Concat.php
    │               │   │   │   ├── Div.php
    │               │   │   │   ├── Minus.php
    │               │   │   │   ├── Mod.php
    │               │   │   │   ├── Mul.php
    │               │   │   │   ├── Plus.php
    │               │   │   │   ├── Pow.php
    │               │   │   │   ├── ShiftLeft.php
    │               │   │   │   └── ShiftRight.php
    │               │   │   ├── AssignOp.php
    │               │   │   ├── AssignRef.php
    │               │   │   ├── BinaryOp
    │               │   │   │   ├── BitwiseAnd.php
    │               │   │   │   ├── BitwiseOr.php
    │               │   │   │   ├── BitwiseXor.php
    │               │   │   │   ├── BooleanAnd.php
    │               │   │   │   ├── BooleanOr.php
    │               │   │   │   ├── Coalesce.php
    │               │   │   │   ├── Concat.php
    │               │   │   │   ├── Div.php
    │               │   │   │   ├── Equal.php
    │               │   │   │   ├── Greater.php
    │               │   │   │   ├── GreaterOrEqual.php
    │               │   │   │   ├── Identical.php
    │               │   │   │   ├── LogicalAnd.php
    │               │   │   │   ├── LogicalOr.php
    │               │   │   │   ├── LogicalXor.php
    │               │   │   │   ├── Minus.php
    │               │   │   │   ├── Mod.php
    │               │   │   │   ├── Mul.php
    │               │   │   │   ├── NotEqual.php
    │               │   │   │   ├── NotIdentical.php
    │               │   │   │   ├── Plus.php
    │               │   │   │   ├── Pow.php
    │               │   │   │   ├── ShiftLeft.php
    │               │   │   │   ├── ShiftRight.php
    │               │   │   │   ├── Smaller.php
    │               │   │   │   ├── SmallerOrEqual.php
    │               │   │   │   └── Spaceship.php
    │               │   │   ├── BinaryOp.php
    │               │   │   ├── BitwiseNot.php
    │               │   │   ├── BooleanNot.php
    │               │   │   ├── CallLike.php
    │               │   │   ├── Cast
    │               │   │   │   ├── Array_.php
    │               │   │   │   ├── Bool_.php
    │               │   │   │   ├── Double.php
    │               │   │   │   ├── Int_.php
    │               │   │   │   ├── Object_.php
    │               │   │   │   ├── String_.php
    │               │   │   │   └── Unset_.php
    │               │   │   ├── Cast.php
    │               │   │   ├── ClassConstFetch.php
    │               │   │   ├── Clone_.php
    │               │   │   ├── Closure.php
    │               │   │   ├── ClosureUse.php
    │               │   │   ├── ConstFetch.php
    │               │   │   ├── Empty_.php
    │               │   │   ├── Error.php
    │               │   │   ├── ErrorSuppress.php
    │               │   │   ├── Eval_.php
    │               │   │   ├── Exit_.php
    │               │   │   ├── FuncCall.php
    │               │   │   ├── Include_.php
    │               │   │   ├── Instanceof_.php
    │               │   │   ├── Isset_.php
    │               │   │   ├── List_.php
    │               │   │   ├── Match_.php
    │               │   │   ├── MethodCall.php
    │               │   │   ├── New_.php
    │               │   │   ├── NullsafeMethodCall.php
    │               │   │   ├── NullsafePropertyFetch.php
    │               │   │   ├── PostDec.php
    │               │   │   ├── PostInc.php
    │               │   │   ├── PreDec.php
    │               │   │   ├── PreInc.php
    │               │   │   ├── Print_.php
    │               │   │   ├── PropertyFetch.php
    │               │   │   ├── ShellExec.php
    │               │   │   ├── StaticCall.php
    │               │   │   ├── StaticPropertyFetch.php
    │               │   │   ├── Ternary.php
    │               │   │   ├── Throw_.php
    │               │   │   ├── UnaryMinus.php
    │               │   │   ├── UnaryPlus.php
    │               │   │   ├── Variable.php
    │               │   │   ├── YieldFrom.php
    │               │   │   └── Yield_.php
    │               │   ├── Expr.php
    │               │   ├── FunctionLike.php
    │               │   ├── Identifier.php
    │               │   ├── InterpolatedStringPart.php
    │               │   ├── IntersectionType.php
    │               │   ├── MatchArm.php
    │               │   ├── Name
    │               │   │   ├── FullyQualified.php
    │               │   │   └── Relative.php
    │               │   ├── Name.php
    │               │   ├── NullableType.php
    │               │   ├── Param.php
    │               │   ├── PropertyItem.php
    │               │   ├── Scalar
    │               │   │   ├── DNumber.php
    │               │   │   ├── Encapsed.php
    │               │   │   ├── EncapsedStringPart.php
    │               │   │   ├── Float_.php
    │               │   │   ├── Int_.php
    │               │   │   ├── InterpolatedString.php
    │               │   │   ├── LNumber.php
    │               │   │   ├── MagicConst
    │               │   │   │   ├── Class_.php
    │               │   │   │   ├── Dir.php
    │               │   │   │   ├── File.php
    │               │   │   │   ├── Function_.php
    │               │   │   │   ├── Line.php
    │               │   │   │   ├── Method.php
    │               │   │   │   ├── Namespace_.php
    │               │   │   │   └── Trait_.php
    │               │   │   ├── MagicConst.php
    │               │   │   └── String_.php
    │               │   ├── Scalar.php
    │               │   ├── StaticVar.php
    │               │   ├── Stmt
    │               │   │   ├── Block.php
    │               │   │   ├── Break_.php
    │               │   │   ├── Case_.php
    │               │   │   ├── Catch_.php
    │               │   │   ├── ClassConst.php
    │               │   │   ├── ClassLike.php
    │               │   │   ├── ClassMethod.php
    │               │   │   ├── Class_.php
    │               │   │   ├── Const_.php
    │               │   │   ├── Continue_.php
    │               │   │   ├── DeclareDeclare.php
    │               │   │   ├── Declare_.php
    │               │   │   ├── Do_.php
    │               │   │   ├── Echo_.php
    │               │   │   ├── ElseIf_.php
    │               │   │   ├── Else_.php
    │               │   │   ├── EnumCase.php
    │               │   │   ├── Enum_.php
    │               │   │   ├── Expression.php
    │               │   │   ├── Finally_.php
    │               │   │   ├── For_.php
    │               │   │   ├── Foreach_.php
    │               │   │   ├── Function_.php
    │               │   │   ├── Global_.php
    │               │   │   ├── Goto_.php
    │               │   │   ├── GroupUse.php
    │               │   │   ├── HaltCompiler.php
    │               │   │   ├── If_.php
    │               │   │   ├── InlineHTML.php
    │               │   │   ├── Interface_.php
    │               │   │   ├── Label.php
    │               │   │   ├── Namespace_.php
    │               │   │   ├── Nop.php
    │               │   │   ├── Property.php
    │               │   │   ├── PropertyProperty.php
    │               │   │   ├── Return_.php
    │               │   │   ├── StaticVar.php
    │               │   │   ├── Static_.php
    │               │   │   ├── Switch_.php
    │               │   │   ├── TraitUse.php
    │               │   │   ├── TraitUseAdaptation
    │               │   │   │   ├── Alias.php
    │               │   │   │   └── Precedence.php
    │               │   │   ├── TraitUseAdaptation.php
    │               │   │   ├── Trait_.php
    │               │   │   ├── TryCatch.php
    │               │   │   ├── Unset_.php
    │               │   │   ├── UseUse.php
    │               │   │   ├── Use_.php
    │               │   │   └── While_.php
    │               │   ├── Stmt.php
    │               │   ├── UnionType.php
    │               │   ├── UseItem.php
    │               │   ├── VarLikeIdentifier.php
    │               │   └── VariadicPlaceholder.php
    │               ├── Node.php
    │               ├── NodeAbstract.php
    │               ├── NodeDumper.php
    │               ├── NodeFinder.php
    │               ├── NodeTraverser.php
    │               ├── NodeTraverserInterface.php
    │               ├── NodeVisitor
    │               │   ├── CloningVisitor.php
    │               │   ├── CommentAnnotatingVisitor.php
    │               │   ├── FindingVisitor.php
    │               │   ├── FirstFindingVisitor.php
    │               │   ├── NameResolver.php
    │               │   ├── NodeConnectingVisitor.php
    │               │   └── ParentConnectingVisitor.php
    │               ├── NodeVisitor.php
    │               ├── NodeVisitorAbstract.php
    │               ├── Parser
    │               │   ├── Php7.php
    │               │   └── Php8.php
    │               ├── Parser.php
    │               ├── ParserAbstract.php
    │               ├── ParserFactory.php
    │               ├── PhpVersion.php
    │               ├── PrettyPrinter
    │               │   └── Standard.php
    │               ├── PrettyPrinter.php
    │               ├── PrettyPrinterAbstract.php
    │               ├── Token.php
    │               └── compatibility_tokens.php
    ├── openswoole
    │   └── core
    │       ├── README.md
    │       ├── composer.json
    │       ├── composer.lock
    │       ├── phpunit.xml.dist
    │       ├── src
    │       │   ├── Coroutine
    │       │   │   ├── Client
    │       │   │   │   ├── ClientConfigInterface.php
    │       │   │   │   ├── ClientFactoryInterface.php
    │       │   │   │   ├── ClientProxy.php
    │       │   │   │   ├── MysqliClient.php
    │       │   │   │   ├── MysqliClientFactory.php
    │       │   │   │   ├── MysqliConfig.php
    │       │   │   │   ├── MysqliException.php
    │       │   │   │   ├── MysqliStatementProxy.php
    │       │   │   │   ├── PDOClient.php
    │       │   │   │   ├── PDOClientFactory.php
    │       │   │   │   ├── PDOConfig.php
    │       │   │   │   ├── PDOStatementProxy.php
    │       │   │   │   ├── PostgresClientFactory.php
    │       │   │   │   ├── PostgresConfig.php
    │       │   │   │   ├── RedisClientFactory.php
    │       │   │   │   └── RedisConfig.php
    │       │   │   ├── Pool
    │       │   │   │   └── ClientPool.php
    │       │   │   ├── WaitGroup.php
    │       │   │   └── functions.php
    │       │   ├── Helper.php
    │       │   ├── Process
    │       │   │   └── Manager.php
    │       │   └── Psr
    │       │       ├── Message.php
    │       │       ├── Middleware
    │       │       │   └── StackHandler.php
    │       │       ├── Request.php
    │       │       ├── Response.php
    │       │       ├── ServerRequest.php
    │       │       ├── Stream.php
    │       │       ├── UploadedFile.php
    │       │       └── Uri.php
    │       └── tests
    │           ├── Psr
    │           │   ├── RequestTest.php
    │           │   ├── ResponseTest.php
    │           │   ├── ServerRequestTest.php
    │           │   ├── StreamTest.php
    │           │   ├── UploadedFileTest.php
    │           │   └── UriTest.php
    │           └── bootstrap.php
    ├── phar-io
    │   ├── manifest
    │   │   ├── CHANGELOG.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   ├── composer.lock
    │   │   ├── manifest.xsd
    │   │   ├── src
    │   │   │   ├── ManifestDocumentMapper.php
    │   │   │   ├── ManifestLoader.php
    │   │   │   ├── ManifestSerializer.php
    │   │   │   ├── exceptions
    │   │   │   │   ├── ElementCollectionException.php
    │   │   │   │   ├── Exception.php
    │   │   │   │   ├── InvalidApplicationNameException.php
    │   │   │   │   ├── InvalidEmailException.php
    │   │   │   │   ├── InvalidUrlException.php
    │   │   │   │   ├── ManifestDocumentException.php
    │   │   │   │   ├── ManifestDocumentLoadingException.php
    │   │   │   │   ├── ManifestDocumentMapperException.php
    │   │   │   │   ├── ManifestElementException.php
    │   │   │   │   ├── ManifestLoaderException.php
    │   │   │   │   └── NoEmailAddressException.php
    │   │   │   ├── values
    │   │   │   │   ├── Application.php
    │   │   │   │   ├── ApplicationName.php
    │   │   │   │   ├── Author.php
    │   │   │   │   ├── AuthorCollection.php
    │   │   │   │   ├── AuthorCollectionIterator.php
    │   │   │   │   ├── BundledComponent.php
    │   │   │   │   ├── BundledComponentCollection.php
    │   │   │   │   ├── BundledComponentCollectionIterator.php
    │   │   │   │   ├── CopyrightInformation.php
    │   │   │   │   ├── Email.php
    │   │   │   │   ├── Extension.php
    │   │   │   │   ├── Library.php
    │   │   │   │   ├── License.php
    │   │   │   │   ├── Manifest.php
    │   │   │   │   ├── PhpExtensionRequirement.php
    │   │   │   │   ├── PhpVersionRequirement.php
    │   │   │   │   ├── Requirement.php
    │   │   │   │   ├── RequirementCollection.php
    │   │   │   │   ├── RequirementCollectionIterator.php
    │   │   │   │   ├── Type.php
    │   │   │   │   └── Url.php
    │   │   │   └── xml
    │   │   │       ├── AuthorElement.php
    │   │   │       ├── AuthorElementCollection.php
    │   │   │       ├── BundlesElement.php
    │   │   │       ├── ComponentElement.php
    │   │   │       ├── ComponentElementCollection.php
    │   │   │       ├── ContainsElement.php
    │   │   │       ├── CopyrightElement.php
    │   │   │       ├── ElementCollection.php
    │   │   │       ├── ExtElement.php
    │   │   │       ├── ExtElementCollection.php
    │   │   │       ├── ExtensionElement.php
    │   │   │       ├── LicenseElement.php
    │   │   │       ├── ManifestDocument.php
    │   │   │       ├── ManifestElement.php
    │   │   │       ├── PhpElement.php
    │   │   │       └── RequiresElement.php
    │   │   └── tools
    │   │       └── php-cs-fixer.d
    │   │           ├── PhpdocSingleLineVarFixer.php
    │   │           └── header.txt
    │   └── version
    │       ├── CHANGELOG.md
    │       ├── LICENSE
    │       ├── README.md
    │       ├── composer.json
    │       └── src
    │           ├── BuildMetaData.php
    │           ├── PreReleaseSuffix.php
    │           ├── Version.php
    │           ├── VersionConstraintParser.php
    │           ├── VersionConstraintValue.php
    │           ├── VersionNumber.php
    │           ├── constraints
    │           │   ├── AbstractVersionConstraint.php
    │           │   ├── AndVersionConstraintGroup.php
    │           │   ├── AnyVersionConstraint.php
    │           │   ├── ExactVersionConstraint.php
    │           │   ├── GreaterThanOrEqualToVersionConstraint.php
    │           │   ├── OrVersionConstraintGroup.php
    │           │   ├── SpecificMajorAndMinorVersionConstraint.php
    │           │   ├── SpecificMajorVersionConstraint.php
    │           │   └── VersionConstraint.php
    │           └── exceptions
    │               ├── Exception.php
    │               ├── InvalidPreReleaseSuffixException.php
    │               ├── InvalidVersionException.php
    │               ├── NoBuildMetaDataException.php
    │               ├── NoPreReleaseSuffixException.php
    │               └── UnsupportedVersionConstraintException.php
    ├── phpstan
    │   └── phpstan
    │       ├── LICENSE
    │       ├── README.md
    │       ├── bootstrap.php
    │       ├── composer.json
    │       ├── conf
    │       │   └── bleedingEdge.neon
    │       ├── phpstan
    │       ├── phpstan.phar
    │       └── phpstan.phar.asc
    ├── phpunit
    │   ├── php-code-coverage
    │   │   ├── ChangeLog-10.1.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── CodeCoverage.php
    │   │       ├── Data
    │   │       │   ├── ProcessedCodeCoverageData.php
    │   │       │   └── RawCodeCoverageData.php
    │   │       ├── Driver
    │   │       │   ├── Driver.php
    │   │       │   ├── PcovDriver.php
    │   │       │   ├── Selector.php
    │   │       │   └── XdebugDriver.php
    │   │       ├── Exception
    │   │       │   ├── BranchAndPathCoverageNotSupportedException.php
    │   │       │   ├── DeadCodeDetectionNotSupportedException.php
    │   │       │   ├── DirectoryCouldNotBeCreatedException.php
    │   │       │   ├── Exception.php
    │   │       │   ├── FileCouldNotBeWrittenException.php
    │   │       │   ├── InvalidArgumentException.php
    │   │       │   ├── NoCodeCoverageDriverAvailableException.php
    │   │       │   ├── NoCodeCoverageDriverWithPathCoverageSupportAvailableException.php
    │   │       │   ├── ParserException.php
    │   │       │   ├── PathExistsButIsNotDirectoryException.php
    │   │       │   ├── PcovNotAvailableException.php
    │   │       │   ├── ReflectionException.php
    │   │       │   ├── ReportAlreadyFinalizedException.php
    │   │       │   ├── StaticAnalysisCacheNotConfiguredException.php
    │   │       │   ├── TestIdMissingException.php
    │   │       │   ├── UnintentionallyCoveredCodeException.php
    │   │       │   ├── WriteOperationFailedException.php
    │   │       │   ├── XdebugNotAvailableException.php
    │   │       │   ├── XdebugNotEnabledException.php
    │   │       │   └── XmlException.php
    │   │       ├── Filter.php
    │   │       ├── Node
    │   │       │   ├── AbstractNode.php
    │   │       │   ├── Builder.php
    │   │       │   ├── CrapIndex.php
    │   │       │   ├── Directory.php
    │   │       │   ├── File.php
    │   │       │   └── Iterator.php
    │   │       ├── Report
    │   │       │   ├── Clover.php
    │   │       │   ├── Cobertura.php
    │   │       │   ├── Crap4j.php
    │   │       │   ├── Html
    │   │       │   │   ├── Colors.php
    │   │       │   │   ├── CustomCssFile.php
    │   │       │   │   ├── Facade.php
    │   │       │   │   ├── Renderer
    │   │       │   │   │   ├── Dashboard.php
    │   │       │   │   │   ├── Directory.php
    │   │       │   │   │   ├── File.php
    │   │       │   │   │   └── Template
    │   │       │   │   │       ├── branches.html.dist
    │   │       │   │   │       ├── coverage_bar.html.dist
    │   │       │   │   │       ├── coverage_bar_branch.html.dist
    │   │       │   │   │       ├── css
    │   │       │   │   │       │   ├── bootstrap.min.css
    │   │       │   │   │       │   ├── custom.css
    │   │       │   │   │       │   ├── nv.d3.min.css
    │   │       │   │   │       │   ├── octicons.css
    │   │       │   │   │       │   └── style.css
    │   │       │   │   │       ├── dashboard.html.dist
    │   │       │   │   │       ├── dashboard_branch.html.dist
    │   │       │   │   │       ├── directory.html.dist
    │   │       │   │   │       ├── directory_branch.html.dist
    │   │       │   │   │       ├── directory_item.html.dist
    │   │       │   │   │       ├── directory_item_branch.html.dist
    │   │       │   │   │       ├── file.html.dist
    │   │       │   │   │       ├── file_branch.html.dist
    │   │       │   │   │       ├── file_item.html.dist
    │   │       │   │   │       ├── file_item_branch.html.dist
    │   │       │   │   │       ├── icons
    │   │       │   │   │       │   ├── file-code.svg
    │   │       │   │   │       │   └── file-directory.svg
    │   │       │   │   │       ├── js
    │   │       │   │   │       │   ├── bootstrap.min.js
    │   │       │   │   │       │   ├── d3.min.js
    │   │       │   │   │       │   ├── file.js
    │   │       │   │   │       │   ├── jquery.min.js
    │   │       │   │   │       │   ├── nv.d3.min.js
    │   │       │   │   │       │   └── popper.min.js
    │   │       │   │   │       ├── line.html.dist
    │   │       │   │   │       ├── lines.html.dist
    │   │       │   │   │       ├── method_item.html.dist
    │   │       │   │   │       ├── method_item_branch.html.dist
    │   │       │   │   │       └── paths.html.dist
    │   │       │   │   └── Renderer.php
    │   │       │   ├── PHP.php
    │   │       │   ├── Text.php
    │   │       │   ├── Thresholds.php
    │   │       │   └── Xml
    │   │       │       ├── BuildInformation.php
    │   │       │       ├── Coverage.php
    │   │       │       ├── Directory.php
    │   │       │       ├── Facade.php
    │   │       │       ├── File.php
    │   │       │       ├── Method.php
    │   │       │       ├── Node.php
    │   │       │       ├── Project.php
    │   │       │       ├── Report.php
    │   │       │       ├── Source.php
    │   │       │       ├── Tests.php
    │   │       │       ├── Totals.php
    │   │       │       └── Unit.php
    │   │       ├── StaticAnalysis
    │   │       │   ├── CacheWarmer.php
    │   │       │   ├── CachingFileAnalyser.php
    │   │       │   ├── CodeUnitFindingVisitor.php
    │   │       │   ├── ExecutableLinesFindingVisitor.php
    │   │       │   ├── FileAnalyser.php
    │   │       │   ├── IgnoredLinesFindingVisitor.php
    │   │       │   └── ParsingFileAnalyser.php
    │   │       ├── TestSize
    │   │       │   ├── Known.php
    │   │       │   ├── Large.php
    │   │       │   ├── Medium.php
    │   │       │   ├── Small.php
    │   │       │   ├── TestSize.php
    │   │       │   └── Unknown.php
    │   │       ├── TestStatus
    │   │       │   ├── Failure.php
    │   │       │   ├── Known.php
    │   │       │   ├── Success.php
    │   │       │   ├── TestStatus.php
    │   │       │   └── Unknown.php
    │   │       ├── Util
    │   │       │   ├── Filesystem.php
    │   │       │   └── Percentage.php
    │   │       └── Version.php
    │   ├── php-file-iterator
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── ExcludeIterator.php
    │   │       ├── Facade.php
    │   │       ├── Factory.php
    │   │       └── Iterator.php
    │   ├── php-invoker
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Invoker.php
    │   │       └── exceptions
    │   │           ├── Exception.php
    │   │           ├── ProcessControlExtensionNotLoadedException.php
    │   │           └── TimeoutException.php
    │   ├── php-text-template
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Template.php
    │   │       └── exceptions
    │   │           ├── Exception.php
    │   │           ├── InvalidArgumentException.php
    │   │           └── RuntimeException.php
    │   ├── php-timer
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Duration.php
    │   │       ├── ResourceUsageFormatter.php
    │   │       ├── Timer.php
    │   │       └── exceptions
    │   │           ├── Exception.php
    │   │           ├── NoActiveTimerException.php
    │   │           └── TimeSinceStartOfRequestNotAvailableException.php
    │   └── phpunit
    │       ├── ChangeLog-10.5.md
    │       ├── DEPRECATIONS.md
    │       ├── LICENSE
    │       ├── README.md
    │       ├── SECURITY.md
    │       ├── composer.json
    │       ├── composer.lock
    │       ├── phpunit
    │       ├── phpunit.xsd
    │       ├── schema
    │       │   ├── 10.0.xsd
    │       │   ├── 10.1.xsd
    │       │   ├── 10.2.xsd
    │       │   ├── 10.3.xsd
    │       │   ├── 10.4.xsd
    │       │   ├── 8.5.xsd
    │       │   ├── 9.0.xsd
    │       │   ├── 9.1.xsd
    │       │   ├── 9.2.xsd
    │       │   ├── 9.3.xsd
    │       │   ├── 9.4.xsd
    │       │   └── 9.5.xsd
    │       └── src
    │           ├── Event
    │           │   ├── Dispatcher
    │           │   │   ├── CollectingDispatcher.php
    │           │   │   ├── DeferringDispatcher.php
    │           │   │   ├── DirectDispatcher.php
    │           │   │   ├── Dispatcher.php
    │           │   │   └── SubscribableDispatcher.php
    │           │   ├── Emitter
    │           │   │   ├── DispatchingEmitter.php
    │           │   │   └── Emitter.php
    │           │   ├── Events
    │           │   │   ├── Application
    │           │   │   │   ├── Finished.php
    │           │   │   │   ├── FinishedSubscriber.php
    │           │   │   │   ├── Started.php
    │           │   │   │   └── StartedSubscriber.php
    │           │   │   ├── Event.php
    │           │   │   ├── EventCollection.php
    │           │   │   ├── EventCollectionIterator.php
    │           │   │   ├── Test
    │           │   │   │   ├── Assertion
    │           │   │   │   │   ├── AssertionFailed.php
    │           │   │   │   │   ├── AssertionFailedSubscriber.php
    │           │   │   │   │   ├── AssertionSucceeded.php
    │           │   │   │   │   └── AssertionSucceededSubscriber.php
    │           │   │   │   ├── ComparatorRegistered.php
    │           │   │   │   ├── ComparatorRegisteredSubscriber.php
    │           │   │   │   ├── HookMethod
    │           │   │   │   │   ├── AfterLastTestMethodCalled.php
    │           │   │   │   │   ├── AfterLastTestMethodCalledSubscriber.php
    │           │   │   │   │   ├── AfterLastTestMethodFinished.php
    │           │   │   │   │   ├── AfterLastTestMethodFinishedSubscriber.php
    │           │   │   │   │   ├── AfterTestMethodCalled.php
    │           │   │   │   │   ├── AfterTestMethodCalledSubscriber.php
    │           │   │   │   │   ├── AfterTestMethodFinished.php
    │           │   │   │   │   ├── AfterTestMethodFinishedSubscriber.php
    │           │   │   │   │   ├── BeforeFirstTestMethodCalled.php
    │           │   │   │   │   ├── BeforeFirstTestMethodCalledSubscriber.php
    │           │   │   │   │   ├── BeforeFirstTestMethodErrored.php
    │           │   │   │   │   ├── BeforeFirstTestMethodErroredSubscriber.php
    │           │   │   │   │   ├── BeforeFirstTestMethodFinished.php
    │           │   │   │   │   ├── BeforeFirstTestMethodFinishedSubscriber.php
    │           │   │   │   │   ├── BeforeTestMethodCalled.php
    │           │   │   │   │   ├── BeforeTestMethodCalledSubscriber.php
    │           │   │   │   │   ├── BeforeTestMethodFinished.php
    │           │   │   │   │   ├── BeforeTestMethodFinishedSubscriber.php
    │           │   │   │   │   ├── PostConditionCalled.php
    │           │   │   │   │   ├── PostConditionCalledSubscriber.php
    │           │   │   │   │   ├── PostConditionFinished.php
    │           │   │   │   │   ├── PostConditionFinishedSubscriber.php
    │           │   │   │   │   ├── PreConditionCalled.php
    │           │   │   │   │   ├── PreConditionCalledSubscriber.php
    │           │   │   │   │   ├── PreConditionFinished.php
    │           │   │   │   │   └── PreConditionFinishedSubscriber.php
    │           │   │   │   ├── Issue
    │           │   │   │   │   ├── ConsideredRisky.php
    │           │   │   │   │   ├── ConsideredRiskySubscriber.php
    │           │   │   │   │   ├── DeprecationTriggered.php
    │           │   │   │   │   ├── DeprecationTriggeredSubscriber.php
    │           │   │   │   │   ├── ErrorTriggered.php
    │           │   │   │   │   ├── ErrorTriggeredSubscriber.php
    │           │   │   │   │   ├── NoticeTriggered.php
    │           │   │   │   │   ├── NoticeTriggeredSubscriber.php
    │           │   │   │   │   ├── PhpDeprecationTriggered.php
    │           │   │   │   │   ├── PhpDeprecationTriggeredSubscriber.php
    │           │   │   │   │   ├── PhpNoticeTriggered.php
    │           │   │   │   │   ├── PhpNoticeTriggeredSubscriber.php
    │           │   │   │   │   ├── PhpWarningTriggered.php
    │           │   │   │   │   ├── PhpWarningTriggeredSubscriber.php
    │           │   │   │   │   ├── PhpunitDeprecationTriggered.php
    │           │   │   │   │   ├── PhpunitDeprecationTriggeredSubscriber.php
    │           │   │   │   │   ├── PhpunitErrorTriggered.php
    │           │   │   │   │   ├── PhpunitErrorTriggeredSubscriber.php
    │           │   │   │   │   ├── PhpunitWarningTriggered.php
    │           │   │   │   │   ├── PhpunitWarningTriggeredSubscriber.php
    │           │   │   │   │   ├── WarningTriggered.php
    │           │   │   │   │   └── WarningTriggeredSubscriber.php
    │           │   │   │   ├── Lifecycle
    │           │   │   │   │   ├── DataProviderMethodCalled.php
    │           │   │   │   │   ├── DataProviderMethodCalledSubscriber.php
    │           │   │   │   │   ├── DataProviderMethodFinished.php
    │           │   │   │   │   ├── DataProviderMethodFinishedSubscriber.php
    │           │   │   │   │   ├── Finished.php
    │           │   │   │   │   ├── FinishedSubscriber.php
    │           │   │   │   │   ├── PreparationFailed.php
    │           │   │   │   │   ├── PreparationFailedSubscriber.php
    │           │   │   │   │   ├── PreparationStarted.php
    │           │   │   │   │   ├── PreparationStartedSubscriber.php
    │           │   │   │   │   ├── Prepared.php
    │           │   │   │   │   └── PreparedSubscriber.php
    │           │   │   │   ├── Outcome
    │           │   │   │   │   ├── Errored.php
    │           │   │   │   │   ├── ErroredSubscriber.php
    │           │   │   │   │   ├── Failed.php
    │           │   │   │   │   ├── FailedSubscriber.php
    │           │   │   │   │   ├── MarkedIncomplete.php
    │           │   │   │   │   ├── MarkedIncompleteSubscriber.php
    │           │   │   │   │   ├── Passed.php
    │           │   │   │   │   ├── PassedSubscriber.php
    │           │   │   │   │   ├── Skipped.php
    │           │   │   │   │   └── SkippedSubscriber.php
    │           │   │   │   ├── PrintedUnexpectedOutput.php
    │           │   │   │   ├── PrintedUnexpectedOutputSubscriber.php
    │           │   │   │   └── TestDouble
    │           │   │   │       ├── MockObjectCreated.php
    │           │   │   │       ├── MockObjectCreatedSubscriber.php
    │           │   │   │       ├── MockObjectForAbstractClassCreated.php
    │           │   │   │       ├── MockObjectForAbstractClassCreatedSubscriber.php
    │           │   │   │       ├── MockObjectForIntersectionOfInterfacesCreated.php
    │           │   │   │       ├── MockObjectForIntersectionOfInterfacesCreatedSubscriber.php
    │           │   │   │       ├── MockObjectForTraitCreated.php
    │           │   │   │       ├── MockObjectForTraitCreatedSubscriber.php
    │           │   │   │       ├── MockObjectFromWsdlCreated.php
    │           │   │   │       ├── MockObjectFromWsdlCreatedSubscriber.php
    │           │   │   │       ├── PartialMockObjectCreated.php
    │           │   │   │       ├── PartialMockObjectCreatedSubscriber.php
    │           │   │   │       ├── TestProxyCreated.php
    │           │   │   │       ├── TestProxyCreatedSubscriber.php
    │           │   │   │       ├── TestStubCreated.php
    │           │   │   │       ├── TestStubCreatedSubscriber.php
    │           │   │   │       ├── TestStubForIntersectionOfInterfacesCreated.php
    │           │   │   │       └── TestStubForIntersectionOfInterfacesCreatedSubscriber.php
    │           │   │   ├── TestRunner
    │           │   │   │   ├── BootstrapFinished.php
    │           │   │   │   ├── BootstrapFinishedSubscriber.php
    │           │   │   │   ├── Configured.php
    │           │   │   │   ├── ConfiguredSubscriber.php
    │           │   │   │   ├── DeprecationTriggered.php
    │           │   │   │   ├── DeprecationTriggeredSubscriber.php
    │           │   │   │   ├── EventFacadeSealed.php
    │           │   │   │   ├── EventFacadeSealedSubscriber.php
    │           │   │   │   ├── ExecutionAborted.php
    │           │   │   │   ├── ExecutionAbortedSubscriber.php
    │           │   │   │   ├── ExecutionFinished.php
    │           │   │   │   ├── ExecutionFinishedSubscriber.php
    │           │   │   │   ├── ExecutionStarted.php
    │           │   │   │   ├── ExecutionStartedSubscriber.php
    │           │   │   │   ├── ExtensionBootstrapped.php
    │           │   │   │   ├── ExtensionBootstrappedSubscriber.php
    │           │   │   │   ├── ExtensionLoadedFromPhar.php
    │           │   │   │   ├── ExtensionLoadedFromPharSubscriber.php
    │           │   │   │   ├── Finished.php
    │           │   │   │   ├── FinishedSubscriber.php
    │           │   │   │   ├── GarbageCollectionDisabled.php
    │           │   │   │   ├── GarbageCollectionDisabledSubscriber.php
    │           │   │   │   ├── GarbageCollectionEnabled.php
    │           │   │   │   ├── GarbageCollectionEnabledSubscriber.php
    │           │   │   │   ├── GarbageCollectionTriggered.php
    │           │   │   │   ├── GarbageCollectionTriggeredSubscriber.php
    │           │   │   │   ├── Started.php
    │           │   │   │   ├── StartedSubscriber.php
    │           │   │   │   ├── WarningTriggered.php
    │           │   │   │   └── WarningTriggeredSubscriber.php
    │           │   │   └── TestSuite
    │           │   │       ├── Filtered.php
    │           │   │       ├── FilteredSubscriber.php
    │           │   │       ├── Finished.php
    │           │   │       ├── FinishedSubscriber.php
    │           │   │       ├── Loaded.php
    │           │   │       ├── LoadedSubscriber.php
    │           │   │       ├── Skipped.php
    │           │   │       ├── SkippedSubscriber.php
    │           │   │       ├── Sorted.php
    │           │   │       ├── SortedSubscriber.php
    │           │   │       ├── Started.php
    │           │   │       └── StartedSubscriber.php
    │           │   ├── Exception
    │           │   │   ├── EventAlreadyAssignedException.php
    │           │   │   ├── EventFacadeIsSealedException.php
    │           │   │   ├── Exception.php
    │           │   │   ├── InvalidArgumentException.php
    │           │   │   ├── InvalidEventException.php
    │           │   │   ├── InvalidSubscriberException.php
    │           │   │   ├── MapError.php
    │           │   │   ├── MoreThanOneDataSetFromDataProviderException.php
    │           │   │   ├── NoComparisonFailureException.php
    │           │   │   ├── NoDataSetFromDataProviderException.php
    │           │   │   ├── NoPreviousThrowableException.php
    │           │   │   ├── NoTestCaseObjectOnCallStackException.php
    │           │   │   ├── RuntimeException.php
    │           │   │   ├── SubscriberTypeAlreadyRegisteredException.php
    │           │   │   ├── UnknownEventException.php
    │           │   │   ├── UnknownEventTypeException.php
    │           │   │   ├── UnknownSubscriberException.php
    │           │   │   └── UnknownSubscriberTypeException.php
    │           │   ├── Facade.php
    │           │   ├── Subscriber.php
    │           │   ├── Tracer.php
    │           │   ├── TypeMap.php
    │           │   └── Value
    │           │       ├── ClassMethod.php
    │           │       ├── ComparisonFailure.php
    │           │       ├── ComparisonFailureBuilder.php
    │           │       ├── Runtime
    │           │       │   ├── OperatingSystem.php
    │           │       │   ├── PHP.php
    │           │       │   ├── PHPUnit.php
    │           │       │   └── Runtime.php
    │           │       ├── Telemetry
    │           │       │   ├── Duration.php
    │           │       │   ├── GarbageCollectorStatus.php
    │           │       │   ├── GarbageCollectorStatusProvider.php
    │           │       │   ├── HRTime.php
    │           │       │   ├── Info.php
    │           │       │   ├── MemoryMeter.php
    │           │       │   ├── MemoryUsage.php
    │           │       │   ├── Php81GarbageCollectorStatusProvider.php
    │           │       │   ├── Php83GarbageCollectorStatusProvider.php
    │           │       │   ├── Snapshot.php
    │           │       │   ├── StopWatch.php
    │           │       │   ├── System.php
    │           │       │   ├── SystemMemoryMeter.php
    │           │       │   ├── SystemStopWatch.php
    │           │       │   └── SystemStopWatchWithOffset.php
    │           │       ├── Test
    │           │       │   ├── Phpt.php
    │           │       │   ├── Test.php
    │           │       │   ├── TestCollection.php
    │           │       │   ├── TestCollectionIterator.php
    │           │       │   ├── TestData
    │           │       │   │   ├── DataFromDataProvider.php
    │           │       │   │   ├── DataFromTestDependency.php
    │           │       │   │   ├── TestData.php
    │           │       │   │   ├── TestDataCollection.php
    │           │       │   │   └── TestDataCollectionIterator.php
    │           │       │   ├── TestDox.php
    │           │       │   ├── TestDoxBuilder.php
    │           │       │   ├── TestMethod.php
    │           │       │   └── TestMethodBuilder.php
    │           │       ├── TestSuite
    │           │       │   ├── TestSuite.php
    │           │       │   ├── TestSuiteBuilder.php
    │           │       │   ├── TestSuiteForTestClass.php
    │           │       │   ├── TestSuiteForTestMethodWithDataProvider.php
    │           │       │   └── TestSuiteWithName.php
    │           │       ├── Throwable.php
    │           │       └── ThrowableBuilder.php
    │           ├── Exception.php
    │           ├── Framework
    │           │   ├── Assert
    │           │   │   └── Functions.php
    │           │   ├── Assert.php
    │           │   ├── Attributes
    │           │   │   ├── After.php
    │           │   │   ├── AfterClass.php
    │           │   │   ├── BackupGlobals.php
    │           │   │   ├── BackupStaticProperties.php
    │           │   │   ├── Before.php
    │           │   │   ├── BeforeClass.php
    │           │   │   ├── CodeCoverageIgnore.php
    │           │   │   ├── CoversClass.php
    │           │   │   ├── CoversFunction.php
    │           │   │   ├── CoversNothing.php
    │           │   │   ├── DataProvider.php
    │           │   │   ├── DataProviderExternal.php
    │           │   │   ├── Depends.php
    │           │   │   ├── DependsExternal.php
    │           │   │   ├── DependsExternalUsingDeepClone.php
    │           │   │   ├── DependsExternalUsingShallowClone.php
    │           │   │   ├── DependsOnClass.php
    │           │   │   ├── DependsOnClassUsingDeepClone.php
    │           │   │   ├── DependsOnClassUsingShallowClone.php
    │           │   │   ├── DependsUsingDeepClone.php
    │           │   │   ├── DependsUsingShallowClone.php
    │           │   │   ├── DoesNotPerformAssertions.php
    │           │   │   ├── ExcludeGlobalVariableFromBackup.php
    │           │   │   ├── ExcludeStaticPropertyFromBackup.php
    │           │   │   ├── Group.php
    │           │   │   ├── IgnoreClassForCodeCoverage.php
    │           │   │   ├── IgnoreDeprecations.php
    │           │   │   ├── IgnoreFunctionForCodeCoverage.php
    │           │   │   ├── IgnoreMethodForCodeCoverage.php
    │           │   │   ├── Large.php
    │           │   │   ├── Medium.php
    │           │   │   ├── PostCondition.php
    │           │   │   ├── PreCondition.php
    │           │   │   ├── PreserveGlobalState.php
    │           │   │   ├── RequiresFunction.php
    │           │   │   ├── RequiresMethod.php
    │           │   │   ├── RequiresOperatingSystem.php
    │           │   │   ├── RequiresOperatingSystemFamily.php
    │           │   │   ├── RequiresPhp.php
    │           │   │   ├── RequiresPhpExtension.php
    │           │   │   ├── RequiresPhpunit.php
    │           │   │   ├── RequiresSetting.php
    │           │   │   ├── RunClassInSeparateProcess.php
    │           │   │   ├── RunInSeparateProcess.php
    │           │   │   ├── RunTestsInSeparateProcesses.php
    │           │   │   ├── Small.php
    │           │   │   ├── Test.php
    │           │   │   ├── TestDox.php
    │           │   │   ├── TestWith.php
    │           │   │   ├── TestWithJson.php
    │           │   │   ├── Ticket.php
    │           │   │   ├── UsesClass.php
    │           │   │   ├── UsesFunction.php
    │           │   │   └── WithoutErrorHandler.php
    │           │   ├── Constraint
    │           │   │   ├── Boolean
    │           │   │   │   ├── IsFalse.php
    │           │   │   │   └── IsTrue.php
    │           │   │   ├── Callback.php
    │           │   │   ├── Cardinality
    │           │   │   │   ├── Count.php
    │           │   │   │   ├── GreaterThan.php
    │           │   │   │   ├── IsEmpty.php
    │           │   │   │   ├── LessThan.php
    │           │   │   │   └── SameSize.php
    │           │   │   ├── Constraint.php
    │           │   │   ├── Equality
    │           │   │   │   ├── IsEqual.php
    │           │   │   │   ├── IsEqualCanonicalizing.php
    │           │   │   │   ├── IsEqualIgnoringCase.php
    │           │   │   │   └── IsEqualWithDelta.php
    │           │   │   ├── Exception
    │           │   │   │   ├── Exception.php
    │           │   │   │   ├── ExceptionCode.php
    │           │   │   │   ├── ExceptionMessageIsOrContains.php
    │           │   │   │   └── ExceptionMessageMatchesRegularExpression.php
    │           │   │   ├── Filesystem
    │           │   │   │   ├── DirectoryExists.php
    │           │   │   │   ├── FileExists.php
    │           │   │   │   ├── IsReadable.php
    │           │   │   │   └── IsWritable.php
    │           │   │   ├── IsAnything.php
    │           │   │   ├── IsIdentical.php
    │           │   │   ├── JsonMatches.php
    │           │   │   ├── Math
    │           │   │   │   ├── IsFinite.php
    │           │   │   │   ├── IsInfinite.php
    │           │   │   │   └── IsNan.php
    │           │   │   ├── Object
    │           │   │   │   ├── ObjectEquals.php
    │           │   │   │   └── ObjectHasProperty.php
    │           │   │   ├── Operator
    │           │   │   │   ├── BinaryOperator.php
    │           │   │   │   ├── LogicalAnd.php
    │           │   │   │   ├── LogicalNot.php
    │           │   │   │   ├── LogicalOr.php
    │           │   │   │   ├── LogicalXor.php
    │           │   │   │   ├── Operator.php
    │           │   │   │   └── UnaryOperator.php
    │           │   │   ├── String
    │           │   │   │   ├── IsJson.php
    │           │   │   │   ├── RegularExpression.php
    │           │   │   │   ├── StringContains.php
    │           │   │   │   ├── StringEndsWith.php
    │           │   │   │   ├── StringEqualsStringIgnoringLineEndings.php
    │           │   │   │   ├── StringMatchesFormatDescription.php
    │           │   │   │   └── StringStartsWith.php
    │           │   │   ├── Traversable
    │           │   │   │   ├── ArrayHasKey.php
    │           │   │   │   ├── IsList.php
    │           │   │   │   ├── TraversableContains.php
    │           │   │   │   ├── TraversableContainsEqual.php
    │           │   │   │   ├── TraversableContainsIdentical.php
    │           │   │   │   └── TraversableContainsOnly.php
    │           │   │   └── Type
    │           │   │       ├── IsInstanceOf.php
    │           │   │       ├── IsNull.php
    │           │   │       └── IsType.php
    │           │   ├── DataProviderTestSuite.php
    │           │   ├── Exception
    │           │   │   ├── AssertionFailedError.php
    │           │   │   ├── CodeCoverageException.php
    │           │   │   ├── EmptyStringException.php
    │           │   │   ├── Exception.php
    │           │   │   ├── ExpectationFailedException.php
    │           │   │   ├── GeneratorNotSupportedException.php
    │           │   │   ├── Incomplete
    │           │   │   │   ├── IncompleteTest.php
    │           │   │   │   └── IncompleteTestError.php
    │           │   │   ├── InvalidArgumentException.php
    │           │   │   ├── InvalidCoversTargetException.php
    │           │   │   ├── InvalidDataProviderException.php
    │           │   │   ├── InvalidDependencyException.php
    │           │   │   ├── NoChildTestSuiteException.php
    │           │   │   ├── ObjectEquals
    │           │   │   │   ├── ActualValueIsNotAnObjectException.php
    │           │   │   │   ├── ComparisonMethodDoesNotAcceptParameterTypeException.php
    │           │   │   │   ├── ComparisonMethodDoesNotDeclareBoolReturnTypeException.php
    │           │   │   │   ├── ComparisonMethodDoesNotDeclareExactlyOneParameterException.php
    │           │   │   │   ├── ComparisonMethodDoesNotDeclareParameterTypeException.php
    │           │   │   │   └── ComparisonMethodDoesNotExistException.php
    │           │   │   ├── PhptAssertionFailedError.php
    │           │   │   ├── ProcessIsolationException.php
    │           │   │   ├── Skipped
    │           │   │   │   ├── SkippedTest.php
    │           │   │   │   ├── SkippedTestSuiteError.php
    │           │   │   │   └── SkippedWithMessageException.php
    │           │   │   ├── UnknownClassOrInterfaceException.php
    │           │   │   └── UnknownTypeException.php
    │           │   ├── ExecutionOrderDependency.php
    │           │   ├── MockObject
    │           │   │   ├── ConfigurableMethod.php
    │           │   │   ├── Exception
    │           │   │   │   ├── BadMethodCallException.php
    │           │   │   │   ├── CannotUseOnlyMethodsException.php
    │           │   │   │   ├── Exception.php
    │           │   │   │   ├── IncompatibleReturnValueException.php
    │           │   │   │   ├── MatchBuilderNotFoundException.php
    │           │   │   │   ├── MatcherAlreadyRegisteredException.php
    │           │   │   │   ├── MethodCannotBeConfiguredException.php
    │           │   │   │   ├── MethodNameAlreadyConfiguredException.php
    │           │   │   │   ├── MethodNameNotConfiguredException.php
    │           │   │   │   ├── MethodParametersAlreadyConfiguredException.php
    │           │   │   │   ├── NeverReturningMethodException.php
    │           │   │   │   ├── NoMoreReturnValuesConfiguredException.php
    │           │   │   │   ├── ReflectionException.php
    │           │   │   │   ├── ReturnValueNotConfiguredException.php
    │           │   │   │   └── RuntimeException.php
    │           │   │   ├── Generator
    │           │   │   │   ├── Exception
    │           │   │   │   │   ├── CannotUseAddMethodsException.php
    │           │   │   │   │   ├── ClassIsEnumerationException.php
    │           │   │   │   │   ├── ClassIsFinalException.php
    │           │   │   │   │   ├── ClassIsReadonlyException.php
    │           │   │   │   │   ├── DuplicateMethodException.php
    │           │   │   │   │   ├── Exception.php
    │           │   │   │   │   ├── InvalidMethodNameException.php
    │           │   │   │   │   ├── NameAlreadyInUseException.php
    │           │   │   │   │   ├── OriginalConstructorInvocationRequiredException.php
    │           │   │   │   │   ├── ReflectionException.php
    │           │   │   │   │   ├── RuntimeException.php
    │           │   │   │   │   ├── SoapExtensionNotAvailableException.php
    │           │   │   │   │   ├── UnknownClassException.php
    │           │   │   │   │   ├── UnknownTraitException.php
    │           │   │   │   │   └── UnknownTypeException.php
    │           │   │   │   ├── Generator.php
    │           │   │   │   ├── MockClass.php
    │           │   │   │   ├── MockMethod.php
    │           │   │   │   ├── MockMethodSet.php
    │           │   │   │   ├── MockTrait.php
    │           │   │   │   ├── MockType.php
    │           │   │   │   ├── TemplateLoader.php
    │           │   │   │   └── templates
    │           │   │   │       ├── deprecation.tpl
    │           │   │   │       ├── doubled_method.tpl
    │           │   │   │       ├── doubled_static_method.tpl
    │           │   │   │       ├── intersection.tpl
    │           │   │   │       ├── proxied_method.tpl
    │           │   │   │       ├── test_double_class.tpl
    │           │   │   │       ├── trait_class.tpl
    │           │   │   │       ├── wsdl_class.tpl
    │           │   │   │       └── wsdl_method.tpl
    │           │   │   ├── MockBuilder.php
    │           │   │   └── Runtime
    │           │   │       ├── Api
    │           │   │       │   ├── DoubledCloneMethod.php
    │           │   │       │   ├── Method.php
    │           │   │       │   ├── MockObjectApi.php
    │           │   │       │   ├── ProxiedCloneMethod.php
    │           │   │       │   └── StubApi.php
    │           │   │       ├── Builder
    │           │   │       │   ├── Identity.php
    │           │   │       │   ├── InvocationMocker.php
    │           │   │       │   ├── InvocationStubber.php
    │           │   │       │   ├── MethodNameMatch.php
    │           │   │       │   ├── ParametersMatch.php
    │           │   │       │   └── Stub.php
    │           │   │       ├── Interface
    │           │   │       │   ├── MockObject.php
    │           │   │       │   ├── MockObjectInternal.php
    │           │   │       │   ├── Stub.php
    │           │   │       │   └── StubInternal.php
    │           │   │       ├── Invocation.php
    │           │   │       ├── InvocationHandler.php
    │           │   │       ├── Matcher.php
    │           │   │       ├── MethodNameConstraint.php
    │           │   │       ├── ReturnValueGenerator.php
    │           │   │       ├── Rule
    │           │   │       │   ├── AnyInvokedCount.php
    │           │   │       │   ├── AnyParameters.php
    │           │   │       │   ├── InvocationOrder.php
    │           │   │       │   ├── InvokedAtLeastCount.php
    │           │   │       │   ├── InvokedAtLeastOnce.php
    │           │   │       │   ├── InvokedAtMostCount.php
    │           │   │       │   ├── InvokedCount.php
    │           │   │       │   ├── MethodName.php
    │           │   │       │   ├── Parameters.php
    │           │   │       │   └── ParametersRule.php
    │           │   │       └── Stub
    │           │   │           ├── ConsecutiveCalls.php
    │           │   │           ├── Exception.php
    │           │   │           ├── ReturnArgument.php
    │           │   │           ├── ReturnCallback.php
    │           │   │           ├── ReturnReference.php
    │           │   │           ├── ReturnSelf.php
    │           │   │           ├── ReturnStub.php
    │           │   │           ├── ReturnValueMap.php
    │           │   │           └── Stub.php
    │           │   ├── Reorderable.php
    │           │   ├── SelfDescribing.php
    │           │   ├── Test.php
    │           │   ├── TestBuilder.php
    │           │   ├── TestCase.php
    │           │   ├── TestRunner.php
    │           │   ├── TestSize
    │           │   │   ├── Known.php
    │           │   │   ├── Large.php
    │           │   │   ├── Medium.php
    │           │   │   ├── Small.php
    │           │   │   ├── TestSize.php
    │           │   │   └── Unknown.php
    │           │   ├── TestStatus
    │           │   │   ├── Deprecation.php
    │           │   │   ├── Error.php
    │           │   │   ├── Failure.php
    │           │   │   ├── Incomplete.php
    │           │   │   ├── Known.php
    │           │   │   ├── Notice.php
    │           │   │   ├── Risky.php
    │           │   │   ├── Skipped.php
    │           │   │   ├── Success.php
    │           │   │   ├── TestStatus.php
    │           │   │   ├── Unknown.php
    │           │   │   └── Warning.php
    │           │   ├── TestSuite.php
    │           │   └── TestSuiteIterator.php
    │           ├── Logging
    │           │   ├── EventLogger.php
    │           │   ├── Exception.php
    │           │   ├── JUnit
    │           │   │   ├── JunitXmlLogger.php
    │           │   │   └── Subscriber
    │           │   │       ├── Subscriber.php
    │           │   │       ├── TestErroredSubscriber.php
    │           │   │       ├── TestFailedSubscriber.php
    │           │   │       ├── TestFinishedSubscriber.php
    │           │   │       ├── TestMarkedIncompleteSubscriber.php
    │           │   │       ├── TestPreparationFailedSubscriber.php
    │           │   │       ├── TestPreparationStartedSubscriber.php
    │           │   │       ├── TestPreparedSubscriber.php
    │           │   │       ├── TestRunnerExecutionFinishedSubscriber.php
    │           │   │       ├── TestSkippedSubscriber.php
    │           │   │       ├── TestSuiteFinishedSubscriber.php
    │           │   │       └── TestSuiteStartedSubscriber.php
    │           │   ├── TeamCity
    │           │   │   ├── Subscriber
    │           │   │   │   ├── Subscriber.php
    │           │   │   │   ├── TestConsideredRiskySubscriber.php
    │           │   │   │   ├── TestErroredSubscriber.php
    │           │   │   │   ├── TestFailedSubscriber.php
    │           │   │   │   ├── TestFinishedSubscriber.php
    │           │   │   │   ├── TestMarkedIncompleteSubscriber.php
    │           │   │   │   ├── TestPreparedSubscriber.php
    │           │   │   │   ├── TestRunnerExecutionFinishedSubscriber.php
    │           │   │   │   ├── TestSkippedSubscriber.php
    │           │   │   │   ├── TestSuiteFinishedSubscriber.php
    │           │   │   │   └── TestSuiteStartedSubscriber.php
    │           │   │   └── TeamCityLogger.php
    │           │   └── TestDox
    │           │       ├── HtmlRenderer.php
    │           │       ├── NamePrettifier.php
    │           │       ├── PlainTextRenderer.php
    │           │       └── TestResult
    │           │           ├── Subscriber
    │           │           │   ├── Subscriber.php
    │           │           │   ├── TestConsideredRiskySubscriber.php
    │           │           │   ├── TestErroredSubscriber.php
    │           │           │   ├── TestFailedSubscriber.php
    │           │           │   ├── TestFinishedSubscriber.php
    │           │           │   ├── TestMarkedIncompleteSubscriber.php
    │           │           │   ├── TestPassedSubscriber.php
    │           │           │   ├── TestPreparedSubscriber.php
    │           │           │   ├── TestSkippedSubscriber.php
    │           │           │   ├── TestTriggeredDeprecationSubscriber.php
    │           │           │   ├── TestTriggeredNoticeSubscriber.php
    │           │           │   ├── TestTriggeredPhpDeprecationSubscriber.php
    │           │           │   ├── TestTriggeredPhpNoticeSubscriber.php
    │           │           │   ├── TestTriggeredPhpWarningSubscriber.php
    │           │           │   ├── TestTriggeredPhpunitDeprecationSubscriber.php
    │           │           │   ├── TestTriggeredPhpunitErrorSubscriber.php
    │           │           │   ├── TestTriggeredPhpunitWarningSubscriber.php
    │           │           │   └── TestTriggeredWarningSubscriber.php
    │           │           ├── TestResult.php
    │           │           ├── TestResultCollection.php
    │           │           ├── TestResultCollectionIterator.php
    │           │           └── TestResultCollector.php
    │           ├── Metadata
    │           │   ├── After.php
    │           │   ├── AfterClass.php
    │           │   ├── Api
    │           │   │   ├── CodeCoverage.php
    │           │   │   ├── DataProvider.php
    │           │   │   ├── Dependencies.php
    │           │   │   ├── Groups.php
    │           │   │   ├── HookMethods.php
    │           │   │   └── Requirements.php
    │           │   ├── BackupGlobals.php
    │           │   ├── BackupStaticProperties.php
    │           │   ├── Before.php
    │           │   ├── BeforeClass.php
    │           │   ├── Covers.php
    │           │   ├── CoversClass.php
    │           │   ├── CoversDefaultClass.php
    │           │   ├── CoversFunction.php
    │           │   ├── CoversNothing.php
    │           │   ├── DataProvider.php
    │           │   ├── DependsOnClass.php
    │           │   ├── DependsOnMethod.php
    │           │   ├── DoesNotPerformAssertions.php
    │           │   ├── Exception
    │           │   │   ├── AnnotationsAreNotSupportedForInternalClassesException.php
    │           │   │   ├── Exception.php
    │           │   │   ├── InvalidVersionRequirementException.php
    │           │   │   ├── NoVersionRequirementException.php
    │           │   │   └── ReflectionException.php
    │           │   ├── ExcludeGlobalVariableFromBackup.php
    │           │   ├── ExcludeStaticPropertyFromBackup.php
    │           │   ├── Group.php
    │           │   ├── IgnoreClassForCodeCoverage.php
    │           │   ├── IgnoreDeprecations.php
    │           │   ├── IgnoreFunctionForCodeCoverage.php
    │           │   ├── IgnoreMethodForCodeCoverage.php
    │           │   ├── Metadata.php
    │           │   ├── MetadataCollection.php
    │           │   ├── MetadataCollectionIterator.php
    │           │   ├── Parser
    │           │   │   ├── Annotation
    │           │   │   │   ├── DocBlock.php
    │           │   │   │   └── Registry.php
    │           │   │   ├── AnnotationParser.php
    │           │   │   ├── AttributeParser.php
    │           │   │   ├── CachingParser.php
    │           │   │   ├── Parser.php
    │           │   │   ├── ParserChain.php
    │           │   │   └── Registry.php
    │           │   ├── PostCondition.php
    │           │   ├── PreCondition.php
    │           │   ├── PreserveGlobalState.php
    │           │   ├── RequiresFunction.php
    │           │   ├── RequiresMethod.php
    │           │   ├── RequiresOperatingSystem.php
    │           │   ├── RequiresOperatingSystemFamily.php
    │           │   ├── RequiresPhp.php
    │           │   ├── RequiresPhpExtension.php
    │           │   ├── RequiresPhpunit.php
    │           │   ├── RequiresSetting.php
    │           │   ├── RunClassInSeparateProcess.php
    │           │   ├── RunInSeparateProcess.php
    │           │   ├── RunTestsInSeparateProcesses.php
    │           │   ├── Test.php
    │           │   ├── TestDox.php
    │           │   ├── TestWith.php
    │           │   ├── Uses.php
    │           │   ├── UsesClass.php
    │           │   ├── UsesDefaultClass.php
    │           │   ├── UsesFunction.php
    │           │   ├── Version
    │           │   │   ├── ComparisonRequirement.php
    │           │   │   ├── ConstraintRequirement.php
    │           │   │   └── Requirement.php
    │           │   └── WithoutErrorHandler.php
    │           ├── Runner
    │           │   ├── Baseline
    │           │   │   ├── Baseline.php
    │           │   │   ├── Exception
    │           │   │   │   ├── CannotLoadBaselineException.php
    │           │   │   │   └── FileDoesNotHaveLineException.php
    │           │   │   ├── Generator.php
    │           │   │   ├── Issue.php
    │           │   │   ├── Reader.php
    │           │   │   ├── RelativePathCalculator.php
    │           │   │   ├── Subscriber
    │           │   │   │   ├── Subscriber.php
    │           │   │   │   ├── TestTriggeredDeprecationSubscriber.php
    │           │   │   │   ├── TestTriggeredNoticeSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpDeprecationSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpNoticeSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpWarningSubscriber.php
    │           │   │   │   └── TestTriggeredWarningSubscriber.php
    │           │   │   └── Writer.php
    │           │   ├── CodeCoverage.php
    │           │   ├── ErrorHandler.php
    │           │   ├── Exception
    │           │   │   ├── ClassCannotBeFoundException.php
    │           │   │   ├── ClassDoesNotExtendTestCaseException.php
    │           │   │   ├── ClassIsAbstractException.php
    │           │   │   ├── DirectoryDoesNotExistException.php
    │           │   │   ├── ErrorException.php
    │           │   │   ├── Exception.php
    │           │   │   ├── FileDoesNotExistException.php
    │           │   │   ├── InvalidOrderException.php
    │           │   │   ├── InvalidPhptFileException.php
    │           │   │   ├── NoIgnoredEventException.php
    │           │   │   ├── ParameterDoesNotExistException.php
    │           │   │   ├── PhptExternalFileCannotBeLoadedException.php
    │           │   │   ├── ReflectionException.php
    │           │   │   └── UnsupportedPhptSectionException.php
    │           │   ├── Extension
    │           │   │   ├── Extension.php
    │           │   │   ├── ExtensionBootstrapper.php
    │           │   │   ├── Facade.php
    │           │   │   ├── ParameterCollection.php
    │           │   │   └── PharLoader.php
    │           │   ├── Filter
    │           │   │   ├── ExcludeGroupFilterIterator.php
    │           │   │   ├── Factory.php
    │           │   │   ├── GroupFilterIterator.php
    │           │   │   ├── IncludeGroupFilterIterator.php
    │           │   │   ├── NameFilterIterator.php
    │           │   │   └── TestIdFilterIterator.php
    │           │   ├── GarbageCollection
    │           │   │   ├── GarbageCollectionHandler.php
    │           │   │   └── Subscriber
    │           │   │       ├── ExecutionFinishedSubscriber.php
    │           │   │       ├── ExecutionStartedSubscriber.php
    │           │   │       ├── Subscriber.php
    │           │   │       └── TestFinishedSubscriber.php
    │           │   ├── PhptTestCase.php
    │           │   ├── ResultCache
    │           │   │   ├── DefaultResultCache.php
    │           │   │   ├── NullResultCache.php
    │           │   │   ├── ResultCache.php
    │           │   │   ├── ResultCacheHandler.php
    │           │   │   └── Subscriber
    │           │   │       ├── Subscriber.php
    │           │   │       ├── TestConsideredRiskySubscriber.php
    │           │   │       ├── TestErroredSubscriber.php
    │           │   │       ├── TestFailedSubscriber.php
    │           │   │       ├── TestFinishedSubscriber.php
    │           │   │       ├── TestMarkedIncompleteSubscriber.php
    │           │   │       ├── TestPreparedSubscriber.php
    │           │   │       ├── TestSkippedSubscriber.php
    │           │   │       ├── TestSuiteFinishedSubscriber.php
    │           │   │       └── TestSuiteStartedSubscriber.php
    │           │   ├── TestResult
    │           │   │   ├── Collector.php
    │           │   │   ├── Facade.php
    │           │   │   ├── Issue.php
    │           │   │   ├── PassedTests.php
    │           │   │   ├── Subscriber
    │           │   │   │   ├── BeforeTestClassMethodErroredSubscriber.php
    │           │   │   │   ├── ExecutionStartedSubscriber.php
    │           │   │   │   ├── Subscriber.php
    │           │   │   │   ├── TestConsideredRiskySubscriber.php
    │           │   │   │   ├── TestErroredSubscriber.php
    │           │   │   │   ├── TestFailedSubscriber.php
    │           │   │   │   ├── TestFinishedSubscriber.php
    │           │   │   │   ├── TestMarkedIncompleteSubscriber.php
    │           │   │   │   ├── TestPreparedSubscriber.php
    │           │   │   │   ├── TestRunnerTriggeredDeprecationSubscriber.php
    │           │   │   │   ├── TestRunnerTriggeredWarningSubscriber.php
    │           │   │   │   ├── TestSkippedSubscriber.php
    │           │   │   │   ├── TestSuiteFinishedSubscriber.php
    │           │   │   │   ├── TestSuiteSkippedSubscriber.php
    │           │   │   │   ├── TestSuiteStartedSubscriber.php
    │           │   │   │   ├── TestTriggeredDeprecationSubscriber.php
    │           │   │   │   ├── TestTriggeredErrorSubscriber.php
    │           │   │   │   ├── TestTriggeredNoticeSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpDeprecationSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpNoticeSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpWarningSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpunitDeprecationSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpunitErrorSubscriber.php
    │           │   │   │   ├── TestTriggeredPhpunitWarningSubscriber.php
    │           │   │   │   └── TestTriggeredWarningSubscriber.php
    │           │   │   └── TestResult.php
    │           │   ├── TestSuiteLoader.php
    │           │   ├── TestSuiteSorter.php
    │           │   └── Version.php
    │           ├── TextUI
    │           │   ├── Application.php
    │           │   ├── Command
    │           │   │   ├── Command.php
    │           │   │   ├── Commands
    │           │   │   │   ├── AtLeastVersionCommand.php
    │           │   │   │   ├── GenerateConfigurationCommand.php
    │           │   │   │   ├── ListGroupsCommand.php
    │           │   │   │   ├── ListTestSuitesCommand.php
    │           │   │   │   ├── ListTestsAsTextCommand.php
    │           │   │   │   ├── ListTestsAsXmlCommand.php
    │           │   │   │   ├── MigrateConfigurationCommand.php
    │           │   │   │   ├── ShowHelpCommand.php
    │           │   │   │   ├── ShowVersionCommand.php
    │           │   │   │   ├── VersionCheckCommand.php
    │           │   │   │   └── WarmCodeCoverageCacheCommand.php
    │           │   │   └── Result.php
    │           │   ├── Configuration
    │           │   │   ├── Builder.php
    │           │   │   ├── Cli
    │           │   │   │   ├── Builder.php
    │           │   │   │   ├── Configuration.php
    │           │   │   │   ├── Exception.php
    │           │   │   │   └── XmlConfigurationFileFinder.php
    │           │   │   ├── CodeCoverageFilterRegistry.php
    │           │   │   ├── Configuration.php
    │           │   │   ├── Exception
    │           │   │   │   ├── CannotFindSchemaException.php
    │           │   │   │   ├── CodeCoverageReportNotConfiguredException.php
    │           │   │   │   ├── ConfigurationCannotBeBuiltException.php
    │           │   │   │   ├── Exception.php
    │           │   │   │   ├── FilterNotConfiguredException.php
    │           │   │   │   ├── IncludePathNotConfiguredException.php
    │           │   │   │   ├── LoggingNotConfiguredException.php
    │           │   │   │   ├── NoBaselineException.php
    │           │   │   │   ├── NoBootstrapException.php
    │           │   │   │   ├── NoCacheDirectoryException.php
    │           │   │   │   ├── NoCliArgumentException.php
    │           │   │   │   ├── NoConfigurationFileException.php
    │           │   │   │   ├── NoCoverageCacheDirectoryException.php
    │           │   │   │   ├── NoCustomCssFileException.php
    │           │   │   │   ├── NoDefaultTestSuiteException.php
    │           │   │   │   └── NoPharExtensionDirectoryException.php
    │           │   │   ├── Merger.php
    │           │   │   ├── PhpHandler.php
    │           │   │   ├── Registry.php
    │           │   │   ├── SourceFilter.php
    │           │   │   ├── SourceMapper.php
    │           │   │   ├── TestSuiteBuilder.php
    │           │   │   ├── Value
    │           │   │   │   ├── Constant.php
    │           │   │   │   ├── ConstantCollection.php
    │           │   │   │   ├── ConstantCollectionIterator.php
    │           │   │   │   ├── Directory.php
    │           │   │   │   ├── DirectoryCollection.php
    │           │   │   │   ├── DirectoryCollectionIterator.php
    │           │   │   │   ├── ExtensionBootstrap.php
    │           │   │   │   ├── ExtensionBootstrapCollection.php
    │           │   │   │   ├── ExtensionBootstrapCollectionIterator.php
    │           │   │   │   ├── File.php
    │           │   │   │   ├── FileCollection.php
    │           │   │   │   ├── FileCollectionIterator.php
    │           │   │   │   ├── FilterDirectory.php
    │           │   │   │   ├── FilterDirectoryCollection.php
    │           │   │   │   ├── FilterDirectoryCollectionIterator.php
    │           │   │   │   ├── Group.php
    │           │   │   │   ├── GroupCollection.php
    │           │   │   │   ├── GroupCollectionIterator.php
    │           │   │   │   ├── IniSetting.php
    │           │   │   │   ├── IniSettingCollection.php
    │           │   │   │   ├── IniSettingCollectionIterator.php
    │           │   │   │   ├── Php.php
    │           │   │   │   ├── Source.php
    │           │   │   │   ├── TestDirectory.php
    │           │   │   │   ├── TestDirectoryCollection.php
    │           │   │   │   ├── TestDirectoryCollectionIterator.php
    │           │   │   │   ├── TestFile.php
    │           │   │   │   ├── TestFileCollection.php
    │           │   │   │   ├── TestFileCollectionIterator.php
    │           │   │   │   ├── TestSuite.php
    │           │   │   │   ├── TestSuiteCollection.php
    │           │   │   │   ├── TestSuiteCollectionIterator.php
    │           │   │   │   ├── Variable.php
    │           │   │   │   ├── VariableCollection.php
    │           │   │   │   └── VariableCollectionIterator.php
    │           │   │   └── Xml
    │           │   │       ├── CodeCoverage
    │           │   │       │   ├── CodeCoverage.php
    │           │   │       │   └── Report
    │           │   │       │       ├── Clover.php
    │           │   │       │       ├── Cobertura.php
    │           │   │       │       ├── Crap4j.php
    │           │   │       │       ├── Html.php
    │           │   │       │       ├── Php.php
    │           │   │       │       ├── Text.php
    │           │   │       │       └── Xml.php
    │           │   │       ├── Configuration.php
    │           │   │       ├── DefaultConfiguration.php
    │           │   │       ├── Exception.php
    │           │   │       ├── Generator.php
    │           │   │       ├── Groups.php
    │           │   │       ├── LoadedFromFileConfiguration.php
    │           │   │       ├── Loader.php
    │           │   │       ├── Logging
    │           │   │       │   ├── Junit.php
    │           │   │       │   ├── Logging.php
    │           │   │       │   ├── TeamCity.php
    │           │   │       │   └── TestDox
    │           │   │       │       ├── Html.php
    │           │   │       │       └── Text.php
    │           │   │       ├── Migration
    │           │   │       │   ├── MigrationBuilder.php
    │           │   │       │   ├── MigrationBuilderException.php
    │           │   │       │   ├── MigrationException.php
    │           │   │       │   ├── Migrations
    │           │   │       │   │   ├── ConvertLogTypes.php
    │           │   │       │   │   ├── CoverageCloverToReport.php
    │           │   │       │   │   ├── CoverageCrap4jToReport.php
    │           │   │       │   │   ├── CoverageHtmlToReport.php
    │           │   │       │   │   ├── CoveragePhpToReport.php
    │           │   │       │   │   ├── CoverageTextToReport.php
    │           │   │       │   │   ├── CoverageXmlToReport.php
    │           │   │       │   │   ├── IntroduceCacheDirectoryAttribute.php
    │           │   │       │   │   ├── IntroduceCoverageElement.php
    │           │   │       │   │   ├── LogToReportMigration.php
    │           │   │       │   │   ├── Migration.php
    │           │   │       │   │   ├── MoveAttributesFromFilterWhitelistToCoverage.php
    │           │   │       │   │   ├── MoveAttributesFromRootToCoverage.php
    │           │   │       │   │   ├── MoveCoverageDirectoriesToSource.php
    │           │   │       │   │   ├── MoveWhitelistExcludesToCoverage.php
    │           │   │       │   │   ├── MoveWhitelistIncludesToCoverage.php
    │           │   │       │   │   ├── RemoveBeStrictAboutResourceUsageDuringSmallTestsAttribute.php
    │           │   │       │   │   ├── RemoveBeStrictAboutTodoAnnotatedTestsAttribute.php
    │           │   │       │   │   ├── RemoveCacheResultFileAttribute.php
    │           │   │       │   │   ├── RemoveCacheTokensAttribute.php
    │           │   │       │   │   ├── RemoveConversionToExceptionsAttributes.php
    │           │   │       │   │   ├── RemoveCoverageElementCacheDirectoryAttribute.php
    │           │   │       │   │   ├── RemoveCoverageElementProcessUncoveredFilesAttribute.php
    │           │   │       │   │   ├── RemoveEmptyFilter.php
    │           │   │       │   │   ├── RemoveListeners.php
    │           │   │       │   │   ├── RemoveLogTypes.php
    │           │   │       │   │   ├── RemoveLoggingElements.php
    │           │   │       │   │   ├── RemoveNoInteractionAttribute.php
    │           │   │       │   │   ├── RemovePrinterAttributes.php
    │           │   │       │   │   ├── RemoveTestDoxGroupsElement.php
    │           │   │       │   │   ├── RemoveTestSuiteLoaderAttributes.php
    │           │   │       │   │   ├── RemoveVerboseAttribute.php
    │           │   │       │   │   ├── RenameBackupStaticAttributesAttribute.php
    │           │   │       │   │   ├── RenameBeStrictAboutCoversAnnotationAttribute.php
    │           │   │       │   │   ├── RenameForceCoversAnnotationAttribute.php
    │           │   │       │   │   └── UpdateSchemaLocation.php
    │           │   │       │   ├── Migrator.php
    │           │   │       │   └── SnapshotNodeList.php
    │           │   │       ├── PHPUnit.php
    │           │   │       ├── SchemaDetector
    │           │   │       │   ├── FailedSchemaDetectionResult.php
    │           │   │       │   ├── SchemaDetectionResult.php
    │           │   │       │   ├── SchemaDetector.php
    │           │   │       │   └── SuccessfulSchemaDetectionResult.php
    │           │   │       ├── SchemaFinder.php
    │           │   │       ├── TestSuiteMapper.php
    │           │   │       └── Validator
    │           │   │           ├── ValidationResult.php
    │           │   │           └── Validator.php
    │           │   ├── Exception
    │           │   │   ├── CannotOpenSocketException.php
    │           │   │   ├── Exception.php
    │           │   │   ├── ExtensionsNotConfiguredException.php
    │           │   │   ├── InvalidSocketException.php
    │           │   │   ├── ReflectionException.php
    │           │   │   ├── RuntimeException.php
    │           │   │   ├── TestDirectoryNotFoundException.php
    │           │   │   └── TestFileNotFoundException.php
    │           │   ├── Help.php
    │           │   ├── Output
    │           │   │   ├── Default
    │           │   │   │   ├── ProgressPrinter
    │           │   │   │   │   ├── ProgressPrinter.php
    │           │   │   │   │   └── Subscriber
    │           │   │   │   │       ├── BeforeTestClassMethodErroredSubscriber.php
    │           │   │   │   │       ├── Subscriber.php
    │           │   │   │   │       ├── TestConsideredRiskySubscriber.php
    │           │   │   │   │       ├── TestErroredSubscriber.php
    │           │   │   │   │       ├── TestFailedSubscriber.php
    │           │   │   │   │       ├── TestFinishedSubscriber.php
    │           │   │   │   │       ├── TestMarkedIncompleteSubscriber.php
    │           │   │   │   │       ├── TestPreparedSubscriber.php
    │           │   │   │   │       ├── TestRunnerExecutionStartedSubscriber.php
    │           │   │   │   │       ├── TestSkippedSubscriber.php
    │           │   │   │   │       ├── TestTriggeredDeprecationSubscriber.php
    │           │   │   │   │       ├── TestTriggeredErrorSubscriber.php
    │           │   │   │   │       ├── TestTriggeredNoticeSubscriber.php
    │           │   │   │   │       ├── TestTriggeredPhpDeprecationSubscriber.php
    │           │   │   │   │       ├── TestTriggeredPhpNoticeSubscriber.php
    │           │   │   │   │       ├── TestTriggeredPhpWarningSubscriber.php
    │           │   │   │   │       ├── TestTriggeredPhpunitDeprecationSubscriber.php
    │           │   │   │   │       ├── TestTriggeredPhpunitWarningSubscriber.php
    │           │   │   │   │       └── TestTriggeredWarningSubscriber.php
    │           │   │   │   ├── ResultPrinter.php
    │           │   │   │   └── UnexpectedOutputPrinter.php
    │           │   │   ├── Facade.php
    │           │   │   ├── Printer
    │           │   │   │   ├── DefaultPrinter.php
    │           │   │   │   ├── NullPrinter.php
    │           │   │   │   └── Printer.php
    │           │   │   ├── SummaryPrinter.php
    │           │   │   └── TestDox
    │           │   │       └── ResultPrinter.php
    │           │   ├── ShellExitCodeCalculator.php
    │           │   ├── TestRunner.php
    │           │   └── TestSuiteFilterProcessor.php
    │           └── Util
    │               ├── Cloner.php
    │               ├── Color.php
    │               ├── Exception
    │               │   ├── Exception.php
    │               │   ├── InvalidDirectoryException.php
    │               │   ├── InvalidJsonException.php
    │               │   ├── InvalidVersionOperatorException.php
    │               │   ├── PhpProcessException.php
    │               │   └── XmlException.php
    │               ├── ExcludeList.php
    │               ├── Exporter.php
    │               ├── Filesystem.php
    │               ├── Filter.php
    │               ├── GlobalState.php
    │               ├── Json.php
    │               ├── PHP
    │               │   ├── AbstractPhpProcess.php
    │               │   ├── DefaultPhpProcess.php
    │               │   └── Template
    │               │       ├── PhptTestCase.tpl
    │               │       ├── TestCaseClass.tpl
    │               │       └── TestCaseMethod.tpl
    │               ├── Reflection.php
    │               ├── Test.php
    │               ├── ThrowableToStringMapper.php
    │               ├── VersionComparisonOperator.php
    │               └── Xml
    │                   ├── Loader.php
    │                   └── Xml.php
    ├── predis
    │   └── predis
    │       ├── LICENSE
    │       ├── README.md
    │       ├── autoload.php
    │       ├── composer.json
    │       ├── docker
    │       │   └── unstable_cluster
    │       │       ├── Dockerfile
    │       │       ├── create_cluster.sh
    │       │       ├── docker-compose.yml
    │       │       └── redis.conf
    │       └── src
    │           ├── Autoloader.php
    │           ├── Client.php
    │           ├── ClientConfiguration.php
    │           ├── ClientContextInterface.php
    │           ├── ClientException.php
    │           ├── ClientInterface.php
    │           ├── Cluster
    │           │   ├── ClusterStrategy.php
    │           │   ├── Distributor
    │           │   │   ├── DistributorInterface.php
    │           │   │   ├── EmptyRingException.php
    │           │   │   ├── HashRing.php
    │           │   │   └── KetamaRing.php
    │           │   ├── Hash
    │           │   │   ├── CRC16.php
    │           │   │   ├── HashGeneratorInterface.php
    │           │   │   └── PhpiredisCRC16.php
    │           │   ├── PredisStrategy.php
    │           │   ├── RedisStrategy.php
    │           │   ├── SlotMap.php
    │           │   └── StrategyInterface.php
    │           ├── Collection
    │           │   └── Iterator
    │           │       ├── CursorBasedIterator.php
    │           │       ├── HashKey.php
    │           │       ├── Keyspace.php
    │           │       ├── ListKey.php
    │           │       ├── SetKey.php
    │           │       └── SortedSetKey.php
    │           ├── Command
    │           │   ├── Argument
    │           │   │   ├── ArrayableArgument.php
    │           │   │   ├── Geospatial
    │           │   │   │   ├── AbstractBy.php
    │           │   │   │   ├── ByBox.php
    │           │   │   │   ├── ByInterface.php
    │           │   │   │   ├── ByRadius.php
    │           │   │   │   ├── FromInterface.php
    │           │   │   │   ├── FromLonLat.php
    │           │   │   │   └── FromMember.php
    │           │   │   ├── Search
    │           │   │   │   ├── AggregateArguments.php
    │           │   │   │   ├── AlterArguments.php
    │           │   │   │   ├── CommonArguments.php
    │           │   │   │   ├── CreateArguments.php
    │           │   │   │   ├── CursorArguments.php
    │           │   │   │   ├── DropArguments.php
    │           │   │   │   ├── ExplainArguments.php
    │           │   │   │   ├── ProfileArguments.php
    │           │   │   │   ├── SchemaFields
    │           │   │   │   │   ├── AbstractField.php
    │           │   │   │   │   ├── FieldInterface.php
    │           │   │   │   │   ├── GeoField.php
    │           │   │   │   │   ├── NumericField.php
    │           │   │   │   │   ├── TagField.php
    │           │   │   │   │   ├── TextField.php
    │           │   │   │   │   └── VectorField.php
    │           │   │   │   ├── SearchArguments.php
    │           │   │   │   ├── SpellcheckArguments.php
    │           │   │   │   ├── SugAddArguments.php
    │           │   │   │   ├── SugGetArguments.php
    │           │   │   │   └── SynUpdateArguments.php
    │           │   │   ├── Server
    │           │   │   │   ├── LimitInterface.php
    │           │   │   │   ├── LimitOffsetCount.php
    │           │   │   │   └── To.php
    │           │   │   └── TimeSeries
    │           │   │       ├── AddArguments.php
    │           │   │       ├── AlterArguments.php
    │           │   │       ├── CommonArguments.php
    │           │   │       ├── CreateArguments.php
    │           │   │       ├── DecrByArguments.php
    │           │   │       ├── GetArguments.php
    │           │   │       ├── IncrByArguments.php
    │           │   │       ├── InfoArguments.php
    │           │   │       ├── MGetArguments.php
    │           │   │       ├── MRangeArguments.php
    │           │   │       └── RangeArguments.php
    │           │   ├── Command.php
    │           │   ├── CommandInterface.php
    │           │   ├── Factory.php
    │           │   ├── FactoryInterface.php
    │           │   ├── PrefixableCommandInterface.php
    │           │   ├── Processor
    │           │   │   ├── KeyPrefixProcessor.php
    │           │   │   ├── ProcessorChain.php
    │           │   │   └── ProcessorInterface.php
    │           │   ├── RawCommand.php
    │           │   ├── RawFactory.php
    │           │   ├── Redis
    │           │   │   ├── ACL.php
    │           │   │   ├── APPEND.php
    │           │   │   ├── AUTH.php
    │           │   │   ├── AbstractCommand
    │           │   │   │   └── BZPOPBase.php
    │           │   │   ├── BGREWRITEAOF.php
    │           │   │   ├── BGSAVE.php
    │           │   │   ├── BITCOUNT.php
    │           │   │   ├── BITFIELD.php
    │           │   │   ├── BITOP.php
    │           │   │   ├── BITPOS.php
    │           │   │   ├── BLMOVE.php
    │           │   │   ├── BLMPOP.php
    │           │   │   ├── BLPOP.php
    │           │   │   ├── BRPOP.php
    │           │   │   ├── BRPOPLPUSH.php
    │           │   │   ├── BZMPOP.php
    │           │   │   ├── BZPOPMAX.php
    │           │   │   ├── BZPOPMIN.php
    │           │   │   ├── BloomFilter
    │           │   │   │   ├── BFADD.php
    │           │   │   │   ├── BFEXISTS.php
    │           │   │   │   ├── BFINFO.php
    │           │   │   │   ├── BFINSERT.php
    │           │   │   │   ├── BFLOADCHUNK.php
    │           │   │   │   ├── BFMADD.php
    │           │   │   │   ├── BFMEXISTS.php
    │           │   │   │   ├── BFRESERVE.php
    │           │   │   │   └── BFSCANDUMP.php
    │           │   │   ├── CLIENT.php
    │           │   │   ├── CLUSTER.php
    │           │   │   ├── COMMAND.php
    │           │   │   ├── CONFIG.php
    │           │   │   ├── COPY.php
    │           │   │   ├── Container
    │           │   │   │   ├── ACL.php
    │           │   │   │   ├── AbstractContainer.php
    │           │   │   │   ├── CLUSTER.php
    │           │   │   │   ├── ContainerFactory.php
    │           │   │   │   ├── ContainerInterface.php
    │           │   │   │   ├── FunctionContainer.php
    │           │   │   │   ├── Json
    │           │   │   │   │   └── JSONDEBUG.php
    │           │   │   │   └── Search
    │           │   │   │       ├── FTCONFIG.php
    │           │   │   │       └── FTCURSOR.php
    │           │   │   ├── CountMinSketch
    │           │   │   │   ├── CMSINCRBY.php
    │           │   │   │   ├── CMSINFO.php
    │           │   │   │   ├── CMSINITBYDIM.php
    │           │   │   │   ├── CMSINITBYPROB.php
    │           │   │   │   ├── CMSMERGE.php
    │           │   │   │   └── CMSQUERY.php
    │           │   │   ├── CuckooFilter
    │           │   │   │   ├── CFADD.php
    │           │   │   │   ├── CFADDNX.php
    │           │   │   │   ├── CFCOUNT.php
    │           │   │   │   ├── CFDEL.php
    │           │   │   │   ├── CFEXISTS.php
    │           │   │   │   ├── CFINFO.php
    │           │   │   │   ├── CFINSERT.php
    │           │   │   │   ├── CFINSERTNX.php
    │           │   │   │   ├── CFLOADCHUNK.php
    │           │   │   │   ├── CFMEXISTS.php
    │           │   │   │   ├── CFRESERVE.php
    │           │   │   │   └── CFSCANDUMP.php
    │           │   │   ├── DBSIZE.php
    │           │   │   ├── DECR.php
    │           │   │   ├── DECRBY.php
    │           │   │   ├── DEL.php
    │           │   │   ├── DISCARD.php
    │           │   │   ├── DUMP.php
    │           │   │   ├── ECHO_.php
    │           │   │   ├── EVALSHA.php
    │           │   │   ├── EVALSHA_RO.php
    │           │   │   ├── EVAL_.php
    │           │   │   ├── EVAL_RO.php
    │           │   │   ├── EXEC.php
    │           │   │   ├── EXISTS.php
    │           │   │   ├── EXPIRE.php
    │           │   │   ├── EXPIREAT.php
    │           │   │   ├── EXPIRETIME.php
    │           │   │   ├── FAILOVER.php
    │           │   │   ├── FCALL.php
    │           │   │   ├── FCALL_RO.php
    │           │   │   ├── FLUSHALL.php
    │           │   │   ├── FLUSHDB.php
    │           │   │   ├── FUNCTIONS.php
    │           │   │   ├── GEOADD.php
    │           │   │   ├── GEODIST.php
    │           │   │   ├── GEOHASH.php
    │           │   │   ├── GEOPOS.php
    │           │   │   ├── GEORADIUS.php
    │           │   │   ├── GEORADIUSBYMEMBER.php
    │           │   │   ├── GEOSEARCH.php
    │           │   │   ├── GEOSEARCHSTORE.php
    │           │   │   ├── GET.php
    │           │   │   ├── GETBIT.php
    │           │   │   ├── GETDEL.php
    │           │   │   ├── GETEX.php
    │           │   │   ├── GETRANGE.php
    │           │   │   ├── GETSET.php
    │           │   │   ├── HDEL.php
    │           │   │   ├── HEXISTS.php
    │           │   │   ├── HGET.php
    │           │   │   ├── HGETALL.php
    │           │   │   ├── HINCRBY.php
    │           │   │   ├── HINCRBYFLOAT.php
    │           │   │   ├── HKEYS.php
    │           │   │   ├── HLEN.php
    │           │   │   ├── HMGET.php
    │           │   │   ├── HMSET.php
    │           │   │   ├── HRANDFIELD.php
    │           │   │   ├── HSCAN.php
    │           │   │   ├── HSET.php
    │           │   │   ├── HSETNX.php
    │           │   │   ├── HSTRLEN.php
    │           │   │   ├── HVALS.php
    │           │   │   ├── INCR.php
    │           │   │   ├── INCRBY.php
    │           │   │   ├── INCRBYFLOAT.php
    │           │   │   ├── INFO.php
    │           │   │   ├── Json
    │           │   │   │   ├── JSONARRAPPEND.php
    │           │   │   │   ├── JSONARRINDEX.php
    │           │   │   │   ├── JSONARRINSERT.php
    │           │   │   │   ├── JSONARRLEN.php
    │           │   │   │   ├── JSONARRPOP.php
    │           │   │   │   ├── JSONARRTRIM.php
    │           │   │   │   ├── JSONCLEAR.php
    │           │   │   │   ├── JSONDEBUG.php
    │           │   │   │   ├── JSONDEL.php
    │           │   │   │   ├── JSONFORGET.php
    │           │   │   │   ├── JSONGET.php
    │           │   │   │   ├── JSONMERGE.php
    │           │   │   │   ├── JSONMGET.php
    │           │   │   │   ├── JSONMSET.php
    │           │   │   │   ├── JSONNUMINCRBY.php
    │           │   │   │   ├── JSONOBJKEYS.php
    │           │   │   │   ├── JSONOBJLEN.php
    │           │   │   │   ├── JSONRESP.php
    │           │   │   │   ├── JSONSET.php
    │           │   │   │   ├── JSONSTRAPPEND.php
    │           │   │   │   ├── JSONSTRLEN.php
    │           │   │   │   ├── JSONTOGGLE.php
    │           │   │   │   └── JSONTYPE.php
    │           │   │   ├── KEYS.php
    │           │   │   ├── LASTSAVE.php
    │           │   │   ├── LCS.php
    │           │   │   ├── LINDEX.php
    │           │   │   ├── LINSERT.php
    │           │   │   ├── LLEN.php
    │           │   │   ├── LMOVE.php
    │           │   │   ├── LMPOP.php
    │           │   │   ├── LPOP.php
    │           │   │   ├── LPUSH.php
    │           │   │   ├── LPUSHX.php
    │           │   │   ├── LRANGE.php
    │           │   │   ├── LREM.php
    │           │   │   ├── LSET.php
    │           │   │   ├── LTRIM.php
    │           │   │   ├── MGET.php
    │           │   │   ├── MIGRATE.php
    │           │   │   ├── MONITOR.php
    │           │   │   ├── MOVE.php
    │           │   │   ├── MSET.php
    │           │   │   ├── MSETNX.php
    │           │   │   ├── MULTI.php
    │           │   │   ├── OBJECT_.php
    │           │   │   ├── PERSIST.php
    │           │   │   ├── PEXPIRE.php
    │           │   │   ├── PEXPIREAT.php
    │           │   │   ├── PEXPIRETIME.php
    │           │   │   ├── PFADD.php
    │           │   │   ├── PFCOUNT.php
    │           │   │   ├── PFMERGE.php
    │           │   │   ├── PING.php
    │           │   │   ├── PSETEX.php
    │           │   │   ├── PSUBSCRIBE.php
    │           │   │   ├── PTTL.php
    │           │   │   ├── PUBLISH.php
    │           │   │   ├── PUBSUB.php
    │           │   │   ├── PUNSUBSCRIBE.php
    │           │   │   ├── QUIT.php
    │           │   │   ├── RANDOMKEY.php
    │           │   │   ├── RENAME.php
    │           │   │   ├── RENAMENX.php
    │           │   │   ├── RESTORE.php
    │           │   │   ├── RPOP.php
    │           │   │   ├── RPOPLPUSH.php
    │           │   │   ├── RPUSH.php
    │           │   │   ├── RPUSHX.php
    │           │   │   ├── SADD.php
    │           │   │   ├── SAVE.php
    │           │   │   ├── SCAN.php
    │           │   │   ├── SCARD.php
    │           │   │   ├── SCRIPT.php
    │           │   │   ├── SDIFF.php
    │           │   │   ├── SDIFFSTORE.php
    │           │   │   ├── SELECT.php
    │           │   │   ├── SENTINEL.php
    │           │   │   ├── SET.php
    │           │   │   ├── SETBIT.php
    │           │   │   ├── SETEX.php
    │           │   │   ├── SETNX.php
    │           │   │   ├── SETRANGE.php
    │           │   │   ├── SHUTDOWN.php
    │           │   │   ├── SINTER.php
    │           │   │   ├── SINTERCARD.php
    │           │   │   ├── SINTERSTORE.php
    │           │   │   ├── SISMEMBER.php
    │           │   │   ├── SLAVEOF.php
    │           │   │   ├── SLOWLOG.php
    │           │   │   ├── SMEMBERS.php
    │           │   │   ├── SMISMEMBER.php
    │           │   │   ├── SMOVE.php
    │           │   │   ├── SORT.php
    │           │   │   ├── SORT_RO.php
    │           │   │   ├── SPOP.php
    │           │   │   ├── SRANDMEMBER.php
    │           │   │   ├── SREM.php
    │           │   │   ├── SSCAN.php
    │           │   │   ├── STRLEN.php
    │           │   │   ├── SUBSCRIBE.php
    │           │   │   ├── SUBSTR.php
    │           │   │   ├── SUNION.php
    │           │   │   ├── SUNIONSTORE.php
    │           │   │   ├── Search
    │           │   │   │   ├── FTAGGREGATE.php
    │           │   │   │   ├── FTALIASADD.php
    │           │   │   │   ├── FTALIASDEL.php
    │           │   │   │   ├── FTALIASUPDATE.php
    │           │   │   │   ├── FTALTER.php
    │           │   │   │   ├── FTCONFIG.php
    │           │   │   │   ├── FTCREATE.php
    │           │   │   │   ├── FTCURSOR.php
    │           │   │   │   ├── FTDICTADD.php
    │           │   │   │   ├── FTDICTDEL.php
    │           │   │   │   ├── FTDICTDUMP.php
    │           │   │   │   ├── FTDROPINDEX.php
    │           │   │   │   ├── FTEXPLAIN.php
    │           │   │   │   ├── FTINFO.php
    │           │   │   │   ├── FTPROFILE.php
    │           │   │   │   ├── FTSEARCH.php
    │           │   │   │   ├── FTSPELLCHECK.php
    │           │   │   │   ├── FTSUGADD.php
    │           │   │   │   ├── FTSUGDEL.php
    │           │   │   │   ├── FTSUGGET.php
    │           │   │   │   ├── FTSUGLEN.php
    │           │   │   │   ├── FTSYNDUMP.php
    │           │   │   │   ├── FTSYNUPDATE.php
    │           │   │   │   └── FTTAGVALS.php
    │           │   │   ├── TDigest
    │           │   │   │   ├── TDIGESTADD.php
    │           │   │   │   ├── TDIGESTBYRANK.php
    │           │   │   │   ├── TDIGESTBYREVRANK.php
    │           │   │   │   ├── TDIGESTCDF.php
    │           │   │   │   ├── TDIGESTCREATE.php
    │           │   │   │   ├── TDIGESTINFO.php
    │           │   │   │   ├── TDIGESTMAX.php
    │           │   │   │   ├── TDIGESTMERGE.php
    │           │   │   │   ├── TDIGESTMIN.php
    │           │   │   │   ├── TDIGESTQUANTILE.php
    │           │   │   │   ├── TDIGESTRANK.php
    │           │   │   │   ├── TDIGESTRESET.php
    │           │   │   │   ├── TDIGESTREVRANK.php
    │           │   │   │   └── TDIGESTTRIMMED_MEAN.php
    │           │   │   ├── TIME.php
    │           │   │   ├── TOUCH.php
    │           │   │   ├── TTL.php
    │           │   │   ├── TYPE.php
    │           │   │   ├── TimeSeries
    │           │   │   │   ├── TSADD.php
    │           │   │   │   ├── TSALTER.php
    │           │   │   │   ├── TSCREATE.php
    │           │   │   │   ├── TSCREATERULE.php
    │           │   │   │   ├── TSDECRBY.php
    │           │   │   │   ├── TSDEL.php
    │           │   │   │   ├── TSDELETERULE.php
    │           │   │   │   ├── TSGET.php
    │           │   │   │   ├── TSINCRBY.php
    │           │   │   │   ├── TSINFO.php
    │           │   │   │   ├── TSMADD.php
    │           │   │   │   ├── TSMGET.php
    │           │   │   │   ├── TSMRANGE.php
    │           │   │   │   ├── TSMREVRANGE.php
    │           │   │   │   ├── TSQUERYINDEX.php
    │           │   │   │   ├── TSRANGE.php
    │           │   │   │   └── TSREVRANGE.php
    │           │   │   ├── TopK
    │           │   │   │   ├── TOPKADD.php
    │           │   │   │   ├── TOPKINCRBY.php
    │           │   │   │   ├── TOPKINFO.php
    │           │   │   │   ├── TOPKLIST.php
    │           │   │   │   ├── TOPKQUERY.php
    │           │   │   │   └── TOPKRESERVE.php
    │           │   │   ├── UNSUBSCRIBE.php
    │           │   │   ├── UNWATCH.php
    │           │   │   ├── WAITAOF.php
    │           │   │   ├── WATCH.php
    │           │   │   ├── XADD.php
    │           │   │   ├── XDEL.php
    │           │   │   ├── XLEN.php
    │           │   │   ├── XRANGE.php
    │           │   │   ├── XREVRANGE.php
    │           │   │   ├── XTRIM.php
    │           │   │   ├── ZADD.php
    │           │   │   ├── ZCARD.php
    │           │   │   ├── ZCOUNT.php
    │           │   │   ├── ZDIFF.php
    │           │   │   ├── ZDIFFSTORE.php
    │           │   │   ├── ZINCRBY.php
    │           │   │   ├── ZINTER.php
    │           │   │   ├── ZINTERCARD.php
    │           │   │   ├── ZINTERSTORE.php
    │           │   │   ├── ZLEXCOUNT.php
    │           │   │   ├── ZMPOP.php
    │           │   │   ├── ZMSCORE.php
    │           │   │   ├── ZPOPMAX.php
    │           │   │   ├── ZPOPMIN.php
    │           │   │   ├── ZRANDMEMBER.php
    │           │   │   ├── ZRANGE.php
    │           │   │   ├── ZRANGEBYLEX.php
    │           │   │   ├── ZRANGEBYSCORE.php
    │           │   │   ├── ZRANGESTORE.php
    │           │   │   ├── ZRANK.php
    │           │   │   ├── ZREM.php
    │           │   │   ├── ZREMRANGEBYLEX.php
    │           │   │   ├── ZREMRANGEBYRANK.php
    │           │   │   ├── ZREMRANGEBYSCORE.php
    │           │   │   ├── ZREVRANGE.php
    │           │   │   ├── ZREVRANGEBYLEX.php
    │           │   │   ├── ZREVRANGEBYSCORE.php
    │           │   │   ├── ZREVRANK.php
    │           │   │   ├── ZSCAN.php
    │           │   │   ├── ZSCORE.php
    │           │   │   ├── ZUNION.php
    │           │   │   └── ZUNIONSTORE.php
    │           │   ├── RedisFactory.php
    │           │   ├── ScriptCommand.php
    │           │   ├── Strategy
    │           │   │   ├── ContainerCommands
    │           │   │   │   └── Functions
    │           │   │   │       ├── DeleteStrategy.php
    │           │   │   │       ├── DumpStrategy.php
    │           │   │   │       ├── FlushStrategy.php
    │           │   │   │       ├── KillStrategy.php
    │           │   │   │       ├── ListStrategy.php
    │           │   │   │       ├── LoadStrategy.php
    │           │   │   │       ├── RestoreStrategy.php
    │           │   │   │       └── StatsStrategy.php
    │           │   │   ├── StrategyResolverInterface.php
    │           │   │   ├── SubcommandStrategyInterface.php
    │           │   │   └── SubcommandStrategyResolver.php
    │           │   └── Traits
    │           │       ├── Aggregate.php
    │           │       ├── BitByte.php
    │           │       ├── BloomFilters
    │           │       │   ├── BucketSize.php
    │           │       │   ├── Capacity.php
    │           │       │   ├── Error.php
    │           │       │   ├── Expansion.php
    │           │       │   ├── Items.php
    │           │       │   ├── MaxIterations.php
    │           │       │   └── NoCreate.php
    │           │       ├── By
    │           │       │   ├── ByArgument.php
    │           │       │   ├── ByLexByScore.php
    │           │       │   └── GeoBy.php
    │           │       ├── Count.php
    │           │       ├── DB.php
    │           │       ├── Expire
    │           │       │   └── ExpireOptions.php
    │           │       ├── From
    │           │       │   └── GeoFrom.php
    │           │       ├── Get
    │           │       │   └── Get.php
    │           │       ├── Json
    │           │       │   ├── Indent.php
    │           │       │   ├── Newline.php
    │           │       │   ├── NxXxArgument.php
    │           │       │   └── Space.php
    │           │       ├── Keys.php
    │           │       ├── LeftRight.php
    │           │       ├── Limit
    │           │       │   ├── Limit.php
    │           │       │   └── LimitObject.php
    │           │       ├── MinMaxModifier.php
    │           │       ├── Replace.php
    │           │       ├── Rev.php
    │           │       ├── Sorting.php
    │           │       ├── Storedist.php
    │           │       ├── Timeout.php
    │           │       ├── To
    │           │       │   └── ServerTo.php
    │           │       ├── Weights.php
    │           │       └── With
    │           │           ├── WithCoord.php
    │           │           ├── WithDist.php
    │           │           ├── WithHash.php
    │           │           ├── WithScores.php
    │           │           └── WithValues.php
    │           ├── CommunicationException.php
    │           ├── Configuration
    │           │   ├── Option
    │           │   │   ├── Aggregate.php
    │           │   │   ├── CRC16.php
    │           │   │   ├── Cluster.php
    │           │   │   ├── Commands.php
    │           │   │   ├── Connections.php
    │           │   │   ├── Exceptions.php
    │           │   │   ├── Prefix.php
    │           │   │   └── Replication.php
    │           │   ├── OptionInterface.php
    │           │   ├── Options.php
    │           │   └── OptionsInterface.php
    │           ├── Connection
    │           │   ├── AbstractConnection.php
    │           │   ├── AggregateConnectionInterface.php
    │           │   ├── Cluster
    │           │   │   ├── ClusterInterface.php
    │           │   │   ├── PredisCluster.php
    │           │   │   └── RedisCluster.php
    │           │   ├── CompositeConnectionInterface.php
    │           │   ├── CompositeStreamConnection.php
    │           │   ├── ConnectionException.php
    │           │   ├── ConnectionInterface.php
    │           │   ├── Factory.php
    │           │   ├── FactoryInterface.php
    │           │   ├── NodeConnectionInterface.php
    │           │   ├── Parameters.php
    │           │   ├── ParametersInterface.php
    │           │   ├── PhpiredisSocketConnection.php
    │           │   ├── PhpiredisStreamConnection.php
    │           │   ├── RelayConnection.php
    │           │   ├── RelayMethods.php
    │           │   ├── Replication
    │           │   │   ├── MasterSlaveReplication.php
    │           │   │   ├── ReplicationInterface.php
    │           │   │   └── SentinelReplication.php
    │           │   ├── StreamConnection.php
    │           │   └── WebdisConnection.php
    │           ├── Monitor
    │           │   └── Consumer.php
    │           ├── NotSupportedException.php
    │           ├── Pipeline
    │           │   ├── Atomic.php
    │           │   ├── ConnectionErrorProof.php
    │           │   ├── FireAndForget.php
    │           │   ├── Pipeline.php
    │           │   ├── RelayAtomic.php
    │           │   └── RelayPipeline.php
    │           ├── PredisException.php
    │           ├── Protocol
    │           │   ├── ProtocolException.php
    │           │   ├── ProtocolProcessorInterface.php
    │           │   ├── RequestSerializerInterface.php
    │           │   ├── ResponseReaderInterface.php
    │           │   └── Text
    │           │       ├── CompositeProtocolProcessor.php
    │           │       ├── Handler
    │           │       │   ├── BulkResponse.php
    │           │       │   ├── ErrorResponse.php
    │           │       │   ├── IntegerResponse.php
    │           │       │   ├── MultiBulkResponse.php
    │           │       │   ├── ResponseHandlerInterface.php
    │           │       │   ├── StatusResponse.php
    │           │       │   └── StreamableMultiBulkResponse.php
    │           │       ├── ProtocolProcessor.php
    │           │       ├── RequestSerializer.php
    │           │       └── ResponseReader.php
    │           ├── PubSub
    │           │   ├── AbstractConsumer.php
    │           │   ├── Consumer.php
    │           │   ├── DispatcherLoop.php
    │           │   └── RelayConsumer.php
    │           ├── Replication
    │           │   ├── MissingMasterException.php
    │           │   ├── ReplicationStrategy.php
    │           │   └── RoleException.php
    │           ├── Response
    │           │   ├── Error.php
    │           │   ├── ErrorInterface.php
    │           │   ├── Iterator
    │           │   │   ├── MultiBulk.php
    │           │   │   ├── MultiBulkIterator.php
    │           │   │   └── MultiBulkTuple.php
    │           │   ├── ResponseInterface.php
    │           │   ├── ServerException.php
    │           │   └── Status.php
    │           ├── Session
    │           │   └── Handler.php
    │           └── Transaction
    │               ├── AbortedMultiExecException.php
    │               ├── MultiExec.php
    │               └── MultiExecState.php
    ├── psr
    │   ├── container
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── ContainerExceptionInterface.php
    │   │       ├── ContainerInterface.php
    │   │       └── NotFoundExceptionInterface.php
    │   ├── http-client
    │   │   ├── CHANGELOG.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── ClientExceptionInterface.php
    │   │       ├── ClientInterface.php
    │   │       ├── NetworkExceptionInterface.php
    │   │       └── RequestExceptionInterface.php
    │   ├── http-factory
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── RequestFactoryInterface.php
    │   │       ├── ResponseFactoryInterface.php
    │   │       ├── ServerRequestFactoryInterface.php
    │   │       ├── StreamFactoryInterface.php
    │   │       ├── UploadedFileFactoryInterface.php
    │   │       └── UriFactoryInterface.php
    │   ├── http-message
    │   │   ├── CHANGELOG.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   ├── docs
    │   │   │   ├── PSR7-Interfaces.md
    │   │   │   └── PSR7-Usage.md
    │   │   └── src
    │   │       ├── MessageInterface.php
    │   │       ├── RequestInterface.php
    │   │       ├── ResponseInterface.php
    │   │       ├── ServerRequestInterface.php
    │   │       ├── StreamInterface.php
    │   │       ├── UploadedFileInterface.php
    │   │       └── UriInterface.php
    │   ├── http-server-handler
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       └── RequestHandlerInterface.php
    │   ├── http-server-middleware
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       └── MiddlewareInterface.php
    │   └── log
    │       ├── LICENSE
    │       ├── README.md
    │       ├── composer.json
    │       └── src
    │           ├── AbstractLogger.php
    │           ├── InvalidArgumentException.php
    │           ├── LogLevel.php
    │           ├── LoggerAwareInterface.php
    │           ├── LoggerAwareTrait.php
    │           ├── LoggerInterface.php
    │           ├── LoggerTrait.php
    │           └── NullLogger.php
    ├── ralouphie
    │   └── getallheaders
    │       ├── LICENSE
    │       ├── README.md
    │       ├── composer.json
    │       └── src
    │           └── getallheaders.php
    ├── sebastian
    │   ├── cli-parser
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Parser.php
    │   │       └── exceptions
    │   │           ├── AmbiguousOptionException.php
    │   │           ├── Exception.php
    │   │           ├── OptionDoesNotAllowArgumentException.php
    │   │           ├── RequiredOptionArgumentMissingException.php
    │   │           └── UnknownOptionException.php
    │   ├── code-unit
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── ClassMethodUnit.php
    │   │       ├── ClassUnit.php
    │   │       ├── CodeUnit.php
    │   │       ├── CodeUnitCollection.php
    │   │       ├── CodeUnitCollectionIterator.php
    │   │       ├── FileUnit.php
    │   │       ├── FunctionUnit.php
    │   │       ├── InterfaceMethodUnit.php
    │   │       ├── InterfaceUnit.php
    │   │       ├── Mapper.php
    │   │       ├── TraitMethodUnit.php
    │   │       ├── TraitUnit.php
    │   │       └── exceptions
    │   │           ├── Exception.php
    │   │           ├── InvalidCodeUnitException.php
    │   │           ├── NoTraitException.php
    │   │           └── ReflectionException.php
    │   ├── code-unit-reverse-lookup
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       └── Wizard.php
    │   ├── comparator
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── ArrayComparator.php
    │   │       ├── Comparator.php
    │   │       ├── ComparisonFailure.php
    │   │       ├── DOMNodeComparator.php
    │   │       ├── DateTimeComparator.php
    │   │       ├── ExceptionComparator.php
    │   │       ├── Factory.php
    │   │       ├── MockObjectComparator.php
    │   │       ├── NumericComparator.php
    │   │       ├── ObjectComparator.php
    │   │       ├── ResourceComparator.php
    │   │       ├── ScalarComparator.php
    │   │       ├── SplObjectStorageComparator.php
    │   │       ├── TypeComparator.php
    │   │       └── exceptions
    │   │           ├── Exception.php
    │   │           └── RuntimeException.php
    │   ├── complexity
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Calculator.php
    │   │       ├── Complexity
    │   │       │   ├── Complexity.php
    │   │       │   ├── ComplexityCollection.php
    │   │       │   └── ComplexityCollectionIterator.php
    │   │       ├── Exception
    │   │       │   ├── Exception.php
    │   │       │   └── RuntimeException.php
    │   │       └── Visitor
    │   │           ├── ComplexityCalculatingVisitor.php
    │   │           └── CyclomaticComplexityCalculatingVisitor.php
    │   ├── diff
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Chunk.php
    │   │       ├── Diff.php
    │   │       ├── Differ.php
    │   │       ├── Exception
    │   │       │   ├── ConfigurationException.php
    │   │       │   ├── Exception.php
    │   │       │   └── InvalidArgumentException.php
    │   │       ├── Line.php
    │   │       ├── LongestCommonSubsequenceCalculator.php
    │   │       ├── MemoryEfficientLongestCommonSubsequenceCalculator.php
    │   │       ├── Output
    │   │       │   ├── AbstractChunkOutputBuilder.php
    │   │       │   ├── DiffOnlyOutputBuilder.php
    │   │       │   ├── DiffOutputBuilderInterface.php
    │   │       │   ├── StrictUnifiedDiffOutputBuilder.php
    │   │       │   └── UnifiedDiffOutputBuilder.php
    │   │       ├── Parser.php
    │   │       └── TimeEfficientLongestCommonSubsequenceCalculator.php
    │   ├── environment
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Console.php
    │   │       └── Runtime.php
    │   ├── exporter
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       └── Exporter.php
    │   ├── global-state
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── CodeExporter.php
    │   │       ├── ExcludeList.php
    │   │       ├── Restorer.php
    │   │       ├── Snapshot.php
    │   │       └── exceptions
    │   │           ├── Exception.php
    │   │           └── RuntimeException.php
    │   ├── lines-of-code
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       ├── Counter.php
    │   │       ├── Exception
    │   │       │   ├── Exception.php
    │   │       │   ├── IllogicalValuesException.php
    │   │       │   ├── NegativeValueException.php
    │   │       │   └── RuntimeException.php
    │   │       ├── LineCountingVisitor.php
    │   │       └── LinesOfCode.php
    │   ├── object-enumerator
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   ├── phpunit.xml
    │   │   └── src
    │   │       └── Enumerator.php
    │   ├── object-reflector
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       └── ObjectReflector.php
    │   ├── recursion-context
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   └── src
    │   │       └── Context.php
    │   ├── type
    │   │   ├── ChangeLog.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── SECURITY.md
    │   │   ├── composer.json
    │   │   ├── infection.json
    │   │   └── src
    │   │       ├── Parameter.php
    │   │       ├── ReflectionMapper.php
    │   │       ├── TypeName.php
    │   │       ├── exception
    │   │       │   ├── Exception.php
    │   │       │   └── RuntimeException.php
    │   │       └── type
    │   │           ├── CallableType.php
    │   │           ├── FalseType.php
    │   │           ├── GenericObjectType.php
    │   │           ├── IntersectionType.php
    │   │           ├── IterableType.php
    │   │           ├── MixedType.php
    │   │           ├── NeverType.php
    │   │           ├── NullType.php
    │   │           ├── ObjectType.php
    │   │           ├── SimpleType.php
    │   │           ├── StaticType.php
    │   │           ├── TrueType.php
    │   │           ├── Type.php
    │   │           ├── UnionType.php
    │   │           ├── UnknownType.php
    │   │           └── VoidType.php
    │   └── version
    │       ├── ChangeLog.md
    │       ├── LICENSE
    │       ├── README.md
    │       ├── SECURITY.md
    │       ├── composer.json
    │       └── src
    │           └── Version.php
    ├── symfony
    │   ├── deprecation-contracts
    │   │   ├── CHANGELOG.md
    │   │   ├── LICENSE
    │   │   ├── README.md
    │   │   ├── composer.json
    │   │   └── function.php
    │   ├── polyfill-mbstring
    │   │   ├── LICENSE
    │   │   ├── Mbstring.php
    │   │   ├── README.md
    │   │   ├── Resources
    │   │   │   └── unidata
    │   │   │       ├── caseFolding.php
    │   │   │       ├── lowerCase.php
    │   │   │       ├── titleCaseRegexp.php
    │   │   │       └── upperCase.php
    │   │   ├── bootstrap.php
    │   │   ├── bootstrap80.php
    │   │   └── composer.json
    │   └── var-dumper
    │       ├── CHANGELOG.md
    │       ├── Caster
    │       │   ├── AmqpCaster.php
    │       │   ├── ArgsStub.php
    │       │   ├── Caster.php
    │       │   ├── ClassStub.php
    │       │   ├── ConstStub.php
    │       │   ├── CutArrayStub.php
    │       │   ├── CutStub.php
    │       │   ├── DOMCaster.php
    │       │   ├── DateCaster.php
    │       │   ├── DoctrineCaster.php
    │       │   ├── DsCaster.php
    │       │   ├── DsPairStub.php
    │       │   ├── EnumStub.php
    │       │   ├── ExceptionCaster.php
    │       │   ├── FFICaster.php
    │       │   ├── FiberCaster.php
    │       │   ├── FrameStub.php
    │       │   ├── GmpCaster.php
    │       │   ├── ImagineCaster.php
    │       │   ├── ImgStub.php
    │       │   ├── IntlCaster.php
    │       │   ├── LinkStub.php
    │       │   ├── MemcachedCaster.php
    │       │   ├── MysqliCaster.php
    │       │   ├── PdoCaster.php
    │       │   ├── PgSqlCaster.php
    │       │   ├── ProxyManagerCaster.php
    │       │   ├── RdKafkaCaster.php
    │       │   ├── RedisCaster.php
    │       │   ├── ReflectionCaster.php
    │       │   ├── ResourceCaster.php
    │       │   ├── ScalarStub.php
    │       │   ├── SplCaster.php
    │       │   ├── StubCaster.php
    │       │   ├── SymfonyCaster.php
    │       │   ├── TraceStub.php
    │       │   ├── UninitializedStub.php
    │       │   ├── UuidCaster.php
    │       │   ├── XmlReaderCaster.php
    │       │   └── XmlResourceCaster.php
    │       ├── Cloner
    │       │   ├── AbstractCloner.php
    │       │   ├── ClonerInterface.php
    │       │   ├── Cursor.php
    │       │   ├── Data.php
    │       │   ├── DumperInterface.php
    │       │   ├── Internal
    │       │   │   └── NoDefault.php
    │       │   ├── Stub.php
    │       │   └── VarCloner.php
    │       ├── Command
    │       │   ├── Descriptor
    │       │   │   ├── CliDescriptor.php
    │       │   │   ├── DumpDescriptorInterface.php
    │       │   │   └── HtmlDescriptor.php
    │       │   └── ServerDumpCommand.php
    │       ├── Dumper
    │       │   ├── AbstractDumper.php
    │       │   ├── CliDumper.php
    │       │   ├── ContextProvider
    │       │   │   ├── CliContextProvider.php
    │       │   │   ├── ContextProviderInterface.php
    │       │   │   ├── RequestContextProvider.php
    │       │   │   └── SourceContextProvider.php
    │       │   ├── ContextualizedDumper.php
    │       │   ├── DataDumperInterface.php
    │       │   ├── HtmlDumper.php
    │       │   └── ServerDumper.php
    │       ├── Exception
    │       │   └── ThrowingCasterException.php
    │       ├── LICENSE
    │       ├── README.md
    │       ├── Resources
    │       │   ├── bin
    │       │   │   └── var-dump-server
    │       │   ├── css
    │       │   │   └── htmlDescriptor.css
    │       │   ├── functions
    │       │   │   └── dump.php
    │       │   └── js
    │       │       └── htmlDescriptor.js
    │       ├── Server
    │       │   ├── Connection.php
    │       │   └── DumpServer.php
    │       ├── Test
    │       │   └── VarDumperTestTrait.php
    │       ├── VarDumper.php
    │       └── composer.json
    └── theseer
        └── tokenizer
            ├── CHANGELOG.md
            ├── LICENSE
            ├── README.md
            ├── composer.json
            ├── composer.lock
            └── src
                ├── Exception.php
                ├── NamespaceUri.php
                ├── NamespaceUriException.php
                ├── Token.php
                ├── TokenCollection.php
                ├── TokenCollectionException.php
                ├── Tokenizer.php
                └── XMLSerializer.php

455 directories, 3004 files
