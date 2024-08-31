.
├── PROJECT_CONTEXT
├── README.md
├── SUMMARY.md
├── app
├── composer.json
├── composer.lock
├── design
│   ├── advanced-caching-system.md
│   ├── advanced-component-templating-system.md
│   ├── ai-integration-guide.md
│   ├── cache-tag-cleanup-system.md
│   ├── caching-queue-systems-guide.md
│   ├── clustering-scalability-guide.md
│   ├── comprehensive-framework-structure.md
│   ├── content-block-component-services.md
│   ├── diff-based-templating-guide.md
│   ├── diff-based-templating-system.md
│   ├── distributed-locking-system.md
│   ├── event-persistence-system.md
│   ├── event-system-guide.md
│   ├── framework-design-philosophy.md
│   ├── framework-development-roadmap.md
│   ├── phase1-development-guide.md
│   ├── phase2-development-guide.md
│   ├── phase3-development-guide.md
│   ├── rate-limited-catchup-system.md
│   ├── realtime-event-streaming.md
│   ├── server-side-rendering-guide.md
│   ├── state-management-guide.md
│   └── websocket-auth-guide.md
├── devmap.md
├── public
│   ├── index.php
│   └── js
│       └── websocket-handler.js
├── routes
├── serve.sh
├── src
│   ├── AI
│   ├── Application.php
│   ├── Cache
│   ├── Cluster
│   ├── Components
│   │   ├── AboutPage.php
│   │   ├── DynamicContent.php
│   │   ├── Footer.php
│   │   ├── Header.php
│   │   ├── HomePage.php
│   │   ├── MainLayout.php
│   │   └── Sidebar.php
│   ├── Console
│   │   ├── Console.php
│   │   └── stubs
│   │       └── migration.stub
│   ├── Core
│   │   └── Application.php
│   ├── Database
│   │   ├── Migration
│   │   │   ├── Migration.php
│   │   │   └── MigrationManager.php
│   │   ├── Model.php
│   │   └── Relation.php
│   ├── Events
│   ├── Http
│   │   ├── MiddlewareInterface.php
│   │   ├── MiddlewarePipeline.php
│   │   ├── Request.php
│   │   └── Response.php
│   ├── Providers
│   │   ├── DatabaseServiceProvider.php
│   │   └── TemplatingServiceProvider.php
│   ├── Queue
│   ├── Routing
│   │   ├── Route.php
│   │   └── Router.php
│   ├── State
│   ├── Templating
│   │   ├── ComponentRegistry.php
│   │   ├── ComponentService.php
│   │   ├── DiffEngine.php
│   │   ├── LayoutManager.php
│   │   └── RenderEngine.php
│   ├── WebSocket
│   │   ├── UpdateDispatcher.php
│   │   └── WebSocketManager.php
│   └── config
│       ├── app.php
│       └── database.php
├── storage
│   ├── ai_models
│   ├── cache
│   ├── logs
│   └── states
├── tests
│   ├── Integration
│   ├── Performance
│   └── Unit
└── vendor
    ├── autoload.php
    ├── bin
    │   ├── phpstan
    │   ├── phpstan.bat
    │   ├── phpstan.phar
    │   └── phpstan.phar.bat
    ├── composer
    │   ├── ClassLoader.php
    │   ├── InstalledVersions.php
    │   ├── LICENSE
    │   ├── autoload_classmap.php
    │   ├── autoload_files.php
    │   ├── autoload_namespaces.php
    │   ├── autoload_psr4.php
    │   ├── autoload_real.php
    │   ├── autoload_static.php
    │   ├── installed.json
    │   ├── installed.php
    │   └── platform_check.php
    ├── openswoole
    │   └── core
    │       ├── README.md
    │       ├── composer.json
    │       ├── composer.lock
    │       ├── phpunit.xml.dist
    │       ├── src
    │       │   ├── Coroutine
    │       │   │   ├── Client
    │       │   │   │   ├── ClientConfigInterface.php
    │       │   │   │   ├── ClientFactoryInterface.php
    │       │   │   │   ├── ClientProxy.php
    │       │   │   │   ├── MysqliClient.php
    │       │   │   │   ├── MysqliClientFactory.php
    │       │   │   │   ├── MysqliConfig.php
    │       │   │   │   ├── MysqliException.php
    │       │   │   │   ├── MysqliStatementProxy.php
    │       │   │   │   ├── PDOClient.php
    │       │   │   │   ├── PDOClientFactory.php
    │       │   │   │   ├── PDOConfig.php
    │       │   │   │   ├── PDOStatementProxy.php
    │       │   │   │   ├── PostgresClientFactory.php
    │       │   │   │   ├── PostgresConfig.php
    │       │   │   │   ├── RedisClientFactory.php
    │       │   │   │   └── RedisConfig.php
    │       │   │   ├── Pool
    │       │   │   │   └── ClientPool.php
    │       │   │   ├── WaitGroup.php
    │       │   │   └── functions.php
    │       │   ├── Helper.php
    │       │   ├── Process
    │       │   │   └── Manager.php
    │       │   └── Psr
    │       │       ├── Message.php
    │       │       ├── Middleware
    │       │       │   └── StackHandler.php
    │       │       ├── Request.php
    │       │       ├── Response.php
    │       │       ├── ServerRequest.php
    │       │       ├── Stream.php
    │       │       ├── UploadedFile.php
    │       │       └── Uri.php
    │       └── tests
    │           ├── Psr
    │           │   ├── RequestTest.php
    │           │   ├── ResponseTest.php
    │           │   ├── ServerRequestTest.php
    │           │   ├── StreamTest.php
    │           │   ├── UploadedFileTest.php
    │           │   └── UriTest.php
    │           └── bootstrap.php
    ├── phpstan
    │   └── phpstan
    │       ├── LICENSE
    │       ├── README.md
    │       ├── bootstrap.php
    │       ├── composer.json
    │       ├── conf
    │       │   └── bleedingEdge.neon
    │       ├── phpstan
    │       ├── phpstan.phar
    │       └── phpstan.phar.asc
    └── psr
        ├── http-message
        │   ├── CHANGELOG.md
        │   ├── LICENSE
        │   ├── README.md
        │   ├── composer.json
        │   ├── docs
        │   │   ├── PSR7-Interfaces.md
        │   │   └── PSR7-Usage.md
        │   └── src
        │       ├── MessageInterface.php
        │       ├── RequestInterface.php
        │       ├── ResponseInterface.php
        │       ├── ServerRequestInterface.php
        │       ├── StreamInterface.php
        │       ├── UploadedFileInterface.php
        │       └── UriInterface.php
        ├── http-server-handler
        │   ├── LICENSE
        │   ├── README.md
        │   ├── composer.json
        │   └── src
        │       └── RequestHandlerInterface.php
        └── http-server-middleware
            ├── LICENSE
            ├── README.md
            ├── composer.json
            └── src
                └── MiddlewareInterface.php