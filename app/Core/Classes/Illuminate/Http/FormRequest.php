<?php

namespace Core\Classes\Illuminate\Http;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\ValidatedInput;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Validation\ValidationException;

class FormRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    /**
     * The container instance.
     */
    protected Container $container;

    /**
     * Indicates whether validation should stop after the first rule failure.
     */
    protected bool $stopOnFirstFailure = false;

    /**
     * The validator instance.
     */
    protected ?Validator $validator = null;

    /**
     * Get the validator instance for the request.
     * @throws BindingResolutionException
     */
    protected function getValidatorInstance(): Validator
    {
        if ($this->validator) {
            return $this->validator;
        }

        $factory = $this->container->make(ValidationFactory::class);
        $validator = method_exists($this, 'validator')
            ? $this->container->call([$this, 'validator'], compact('factory'))
            : $this->createDefaultValidator($factory);

        if (method_exists($this, 'withValidator')) {
            $this->withValidator($validator);
        }

        $this->setValidator($validator);
        return $this->validator;
    }

    /**
     * Create the default validator instance.
     */
    protected function createDefaultValidator(ValidationFactory $factory): Validator
    {
        $rules = $this->container->call([$this, 'rules']);

        if ($this->isPrecognitive()) {
            $rules = $this->filterPrecognitiveRules($rules);
        }

        return $factory->make(
            $this->validationData(),
            $rules,
            $this->messages(),
            $this->attributes()
        )->stopOnFirstFailure($this->stopOnFirstFailure);
    }

    /**
     * Get data to be validated from the request.
     */
    public function validationData(): array
    {
        return $this->all();
    }

    /**
     * Determine if the request passes the authorization check.
     * @throws AuthorizationException
     */
    protected function passesAuthorization(): bool
    {
        if (!method_exists($this, 'authorize')) {
            return true;
        }

        $result = $this->container->call([$this, 'authorize']);
        return $result instanceof Response
            ? $result->authorize()
            : $result;
    }

    /**
     * Get a validated input container for the validated input.
     */
    public function safe(array $keys = null): array|ValidatedInput
    {
        return is_array($keys)
            ? $this->validator->safe()->only($keys)
            : $this->validator->safe();
    }

    /**
     * Get the validated data from the request.
     * @throws ValidationException
     */
    public function validated(?string $key = null, mixed $default = null): mixed
    {
        return data_get($this->validator->validated(), $key, $default);
    }

    /**
     * Get the route handling the request.
     */
    public function route($param = null, $default = null)
    {
        $parameters = call_user_func($this->getRouteResolver())[2];
        return array_key_exists($param, $parameters) ? $parameters[$param] : $default;
    }

    /**
     * Set the Validator instance.
     */
    public function setValidator(Validator $validator): static
    {
        $this->validator = $validator;
        return $this;
    }

    /**
     * Set the container implementation.
     */
    public function setContainer(Container $container): static
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [];
    }
}
