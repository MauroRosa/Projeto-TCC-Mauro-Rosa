# Use the official PHP 8.3 CLI image as the base
FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    ca-certificates \
    gnupg \
    libzip-dev \
    sudo \    
    && docker-php-ext-install zip pcntl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*    

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ---- Install Node.js (latest LTS) ----
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs

# Verify installs
RUN php -v \
    && composer --version \
    && node --version \
    && npm --version

# ---- Create non-root user ----
ARG USERNAME=dev
ARG USER_UID=1000
ARG USER_GID=1000

RUN groupadd --gid ${USER_GID} ${USERNAME} \
    && useradd --uid ${USER_UID} --gid ${USER_GID} -m ${USERNAME} \
    && mkdir -p /workspace \
    && chown -R ${USERNAME}:${USERNAME} /workspace

RUN echo "dev ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/dev
RUN chmod 0440 /etc/sudoers.d/dev

RUN chsh -s /bin/bash dev

# ---- Switch to non-root ----
USER ${USERNAME}

WORKDIR /workspace
