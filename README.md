# TODO
- [x] Implement organisations and organisation selection based on cookies
- [x] Implement user authentication
- [ ] implement user invites

- [ ] Server creation (using external API's like hetzner)
- [ ] Server management (start, stop, restart, delete)
- [ ] Server monitoring (CPU, RAM, Disk, Network)
- [ ] Server logs (nginx, php, mysql, auth, etc)
- [ ] Server firewall (open ports, close ports, default ports on user authorized IP's)

- [ ] Project creation (generate new SSH key, git repo url, etc)
- [ ] Linking Database and Redis instances to projects (create new or link existing)
- [ ] Zero downtime deployments (start new instance on other server, switch traffic, stop old instance, delete old instance)

- [ ] Load balancing (automatic nginx configuration, automatic server creation, request monitoring from nginx)
- [ ] SSL certificates (automatic creation, automatic renewal, automatic installation)

- [x] Server types (database, redis, web, load balancer, meilisearch)
- [ ] Project shared storage (S3 mount [library](https://github.com/s3fs-fuse/s3fs-fuse))

- [ ] Audit logs (who did what, when)
- [ ] API (documentation, usage, etc, token based authentication)
- [ ] Push to deploy (automatic CI/CD pipelines for github & bitbucket)

- [ ] Notifications (server down, server up, site down, site up, etc)
